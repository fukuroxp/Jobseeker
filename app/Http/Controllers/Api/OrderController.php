<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Category;
use App\Order;
use App\Transaction;
use App\TransactionProduct;

use App\Utils\Util;

use DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
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
        $data = Order::where('business_id', auth()->user()->business_id)
                    ->where('status', 'pending');

        $start = 0;
        $limit = request()->input('limit') ? request()->input('limit') : 20;
        $paged = request()->input('page') ? request()->input('page') : 1;

        $start = ($paged - 1) * $limit; 
        $data = $data->offset($start)->limit($limit)->get();

        foreach($data as $key => $value) {
            $products = [];
            $total = 0;
            foreach($value->products as $key => $prod) {
                $product = Product::with(['category' => function($q) {
                                        $q->select(['id', 'name']);
                                    }])->find($prod['product_id']);
                $product->qty = $prod['qty'];
                $total += ($prod['qty'] * $product->sell_price);
                $products[] = $product;
            }
            $data[$key]->total = $total;
            $data[$key]->order_date = strftime("%A, %d %B %Y", strtotime($value->created_at));
            $data[$key]->products = $products;
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
            $order_data = $request->only(['business_id', 'table_id', 'products']);
            $order_data['status'] = 'pending';
            $order_data['customer_id'] = auth()->user()->id;

            $order = Order::create($order_data);
            
            $products = [];
            $total = 0;
            foreach($order->products as $key => $prod) {
                $product = Product::with(['category' => function($q) {
                                        $q->select(['id', 'name']);
                                    }])->find($prod['product_id']);
                $product->qty = $prod['qty'];
                $total += ($prod['qty'] * $product->sell_price);
                $products[] = $product;
            }
            $order->total = $total;
            $order->order_date = strftime("%A, %d %B %Y", strtotime($order->created_at));
            $order->products = $products;

            return $this->respondSuccess('Berhasil memesan', $order);
        } catch(\Exception $e) {
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

    public function getProductSuggestion($business_id)
    {
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

    public function accept($id)
    {
        try {
            $order = Order::findOrFail($id);

            if($order->status != 'pending') {
                return $this->respondFailed('Order telah diproses sebelumnya');
            }

            DB::beginTransaction();

            $order->status = 'accepted';
            $order->save();

            $sell_data = [
                'order_id' => $order->id,
                'business_id' => $order->business_id,
                'table_id' => $order->table_id,
                'customer_id' => $order->customer_id,
                'employee_id' => auth()->user()->id,
                'ref_no' => $this->commonUtil->generateTrxRefNo(),
                'type' => 'sells',
                'status' => 'final',
                'payment_status' => 'unpaid'
            ];

            $transaction = Transaction::create($sell_data);
            $products = [];
            $total = 0;

            $product_data = $order->products;
            foreach($product_data as $key => $product) {
                $qty = $product['qty'];
                $product = $this->commonUtil->getProductData($product['product_id'], $qty);
                $total += ($product->sell_price * $qty);
                $temp = [
                    'business_id' => $order->business_id,
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'product' => $product->name,
                    'qty' => $qty,
                    'unit_price' => $product->sell_price
                ];
                $products[] = $temp;
                TransactionProduct::create($temp);
            }

            $transaction->update(['total' => $total]);
            $transaction->products = $products;

            DB::commit();

            return $this->respondSuccess('Berhasil melakukan transaksi penjualan', $transaction);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->respondFailed();
        }
    }

    public function reject($id)
    {
        $order = Order::find($id);
        $order->status = 'rejected';
        $order->save();

        return $this->respondSuccess('Berhasil menolak pesanan', $order);
    }
}
