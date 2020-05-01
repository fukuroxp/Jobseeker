<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::where('business_id', auth()->user()->business_id)->get();
        return view('product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('business_id', auth()->user()->business_id)->get()->pluck('name', 'id');
        $sku = $this->generateSku();
        return view('product.create', compact('categories', 'sku'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'sku' => 'required',
            'description' => 'required',
            'purchase_price' => 'required',
            'sell_price' => 'required',
            'qty' => 'required',
            'image' => 'required|image'
        ]);

        try {
            $input = $request->except(['_token', 'margin']);
            $input['business_id'] = auth()->user()->business_id;

            if ($request->hasFile('image')) {
                $input['image'] = time().'.'.request()->image->getClientOriginalExtension();
                
                request()->image->move(public_path('uploads/images/'), $input['image']);
            }

            Product::create($input);

            flash('Berhasil menambahkan produk')->success();
        } catch(\Exception $e) {
            flash($e->getMessage())->error();
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Product::find($id);
        return view('product.stock', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('business_id', auth()->user()->business_id)->get()->pluck('name', 'id');
        $data = Product::find($id);
        return view('product.edit', compact('data', 'categories'));
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
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'sku' => 'required',
            'description' => 'required',
            'purchase_price' => 'required',
            'sell_price' => 'required'
        ]);

        try {
            $input = $request->except(['_token', 'margin']);
            $input['business_id'] = auth()->user()->business_id;

            if ($request->hasFile('image')) {
                $input['image'] = time().'.'.request()->image->getClientOriginalExtension();
                
                request()->image->move(public_path('uploads/images/'), $input['image']);
            }

            Product::find($id)->update($input);

            flash('Berhasil merubah produk')->success();
        } catch(\Exception $e) {
            flash($e->getMessage())->error();
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Product::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus produk'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus produk'
            ]);
        }
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required'
        ]);

        try {
            $input = $request->only(['qty']);

            Product::find($id)->update($input);

            flash('Berhasil merubah stok produk')->success();
        } catch(\Exception $e) {
            flash($e->getMessage())->error();
        }

        return redirect()->route('products.index');
    }

    public function generateSku()
    {
        $count = Product::where('business_id', auth()->user()->business_id)->withTrashed()->count() + 1;
        $prefix = auth()->user()->business->prefixes['sku'];

        return $prefix.str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
