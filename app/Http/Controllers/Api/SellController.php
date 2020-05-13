<?php

namespace App\Http\Controllers\Api;

use App\Transaction;
use App\TransactionProduct;
use App\TransactionPayment;
use App\Product;
use App\Category;
use App\Business;
use App\Order;
use App\User;

use App\Utils\Util;

use DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SellController extends Controller
{
    protected $commonUtil;

    public function __construct(Util $commonUtil)
    {
        $this->commonUtil = $commonUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('Customer')) {
            $data = Business::select(['id', 'name', 'address'])
                            ->whereHas('transactions')
                            ->with(['transactions' => function($q) {
                                $q->where('type', 'sells');
                                $q->where('customer_id', auth()->user()->id);
                                $q->orderBy('created_at', 'DESC');
                                $q->with(['employee' => function($q) {
                                    $q->select(['id', 'name']);
                                }]);
                            }]);
        } else {
            $data = Transaction::where('type', 'sells')
                            ->with([
                                'business' => function($q) {
                                    $q->select(['id', 'name', 'address']);
                                },
                                'employee' => function($q) {
                                    $q->select(['id', 'name']);
                                },
                            ])
                            ->where('business_id', auth()->user()->business_id)
                            ->orderBy('created_at', 'DESC');

            if(request()->input('status')) {
                $data = $data->where('status', request()->input('status'));
            }
        }

        $start = 0;
        $limit = request()->input('limit') ? request()->input('limit') : 20;
        $paged = request()->input('page') ? request()->input('page') : 1;

        $start = ($paged - 1) * $limit; 
        $data = $data->offset($start)->limit($limit)->get();

        if(auth()->user()->hasRole('Customer')) {
            foreach($data as $business_id => $business) {
                foreach($business->transactions as $key => $value) {
                    $products = [];
                    foreach($value->transaction_products as $tp) {
                        $product = Product::with(['category' => function($q) {
                                                $q->select(['id', 'name']);
                                            }])->find($tp->product_id);
                        $product->qty = $tp->qty;
                        $products[] = $product;
                    }
                    $data[$business_id]['transactions'][$key]->transaction_date = strftime("%A, %d %B %Y", strtotime($value->created_at));
                    unset($data[$business_id]['transactions'][$key]->transaction_products);
                    $data[$business_id]['transactions'][$key]->products = $products;
                }
                if(count($business->transactions) == 0) {
                    unset($data[$business_id]);
                }
            }
        } else {
            foreach($data as $key => $value) {
                $products = [];
                foreach($value->transaction_products as $tp) {
                    $product = Product::with(['category' => function($q) {
                                            $q->select(['id', 'name']);
                                        }])->find($tp->product_id);
                    $product->qty = $tp->qty;
                    $products[] = $product;
                }
                $data[$key]->transaction_date = strftime("%A, %d %B %Y", strtotime($value->created_at));
                unset($data[$key]->transaction_products);
                $data[$key]->products = $products;
            }
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $business_id = auth()->user()->business_id;

            $sell_data = $request->only(['table_id', 'customer_id']);
            $sell_data['business_id'] = $business_id;
            $sell_data['employee_id'] = auth()->user()->id;
            $sell_data['ref_no'] = $this->commonUtil->generateTrxRefNo();
            $sell_data['type'] = 'sells';
            $sell_data['status'] = 'active';
            $sell_data['payment_status'] = 'unpaid';

            DB::beginTransaction();

            $transaction = Transaction::create($sell_data);
            $products = [];
            $total = 0;

            $product_data = $request->input('products');
            foreach($product_data as $key => $product) {
                $qty = $product['qty'];
                $product = $this->commonUtil->getProductData($product['product_id'], $qty);
                $total += ($product->sell_price * $qty);
                $temp = [
                    'business_id' => $business_id,
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'product' => $product->name,
                    'qty' => $qty,
                    'unit_price' => $product->sell_price
                ];
                $products[] = $temp;
                TransactionProduct::create($temp);
                $this->commonUtil->updateStockProduct($product->id, $qty, '-');
            }

            $transaction->update(['total' => $total]);
            $transaction->products = $products;

            DB::commit();
            
            $users = User::where('business_id', $transaction->business_id)->get();
            $this->commonUtil->notify($users, 'sell', 'order', [
                'ref_no' => $transaction->ref_no,
                'table' => 'MANUAL',
                'total' => $transaction->total
            ]);

            return $this->respondSuccess('Berhasil melakukan transaksi penjualan', $transaction);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->respondFailed();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getProductSuggestion()
    {
        $business_id = auth()->user()->business_id;
        $data = Product::where('business_id', $business_id)
                        ->where('qty', '>', 0)
                        ->with(['category' => function($q) {
                            $q->select(['id', 'name']);
                        }])
                        ->orderBy('sell_price', 'ASC');

        if(request()->input('category')) {
            $category = Category::where('name', 'like', '%' . request()->input('category') . '%')
                                ->where('business_id', $business_id)
                                ->first();
            $data = $data->where('category_id', $category->id);
        }

        return $this->respondArray($data);
    }

    public function pay($id)
    {
        try {
            $business_id = auth()->user()->business_id;
            $sell = Transaction::findOrFail($id);
            $amount = request()->input('amount') ?? 0;

            if($sell->payment_status != 'unpaid') {
                return $this->respondFailed('Pembayaran telah diproses sebelumnya');
            }

            if($amount < $sell->total) {
                return $this->respondFailed('Uang tidak mencukupi');
            }

            DB::beginTransaction();

            $sell->payment_status = 'paid';
            $sell->status = 'finish';
            $sell->save();

            if($sell->order_id) {
                $order = Order::find($sell->order_id);
                $order->status = 'finished';
                $order->save();
            }

            $tp = TransactionPayment::create([
                'business_id' => $business_id,
                'transaction_id' => $sell->id,
                'customer_id' => $sell->customer_id,
                'employee_id' => auth()->user()->id,
                'ref_no' => $this->commonUtil->generatePaymentRefNo(),
                'type' => 'credit',
                'amount' => $amount,
                'method' => 'cash',
                'description' => 'Penjualan Barang'
            ]);
            
            $products = [];
            foreach($sell->transaction_products as $tprod) {
                $product = Product::find($tprod->product_id);
                $product->qty = $tprod->qty;
                $products[] = $product;
            }
            unset($sell->transaction_products);
            $sell->products = $products;
            
            DB::commit();
            
            $users = User::where('business_id', $sell->business_id)->get();
            $prefix = Business::find($sell->business_id)->prefixes['table'];
            $this->commonUtil->notify($users, 'pay', 'order', [
                'ref_no' => $sell->ref_no,
                'total' => $tp->amount
            ]);
            
            return $this->respondSuccess('Berhasil menyelesaikan transaksi penjualan', $sell);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->respondFailed();
        }
    }
}
