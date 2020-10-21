<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Category;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prod=Product::all();
        return response()->json($prod);
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
        $prod = new Product;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $filename = time().'.'.$ext;
            $path = public_path().'/uploads/';
            $image->move($path,$filename);
        } else {
            $filename = 'image-not-found.png';
        }
        $prod->product = $request->input('product');
        $prod->price = $request->input('price');
        $prod->categoryid = $request->input('categoryid');
        $prod->description = $request->input('description');
        $prod->image = $filename;
        $prod->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $prod=Product::where('id',$product->id)->get();
        return response()->json($prod);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $prod=Product::find($product);
        return response()->json($prod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prod = Product::find($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $filename = time().'.'.$ext;
            $path = public_path().'/uploads/';
            $image->move($path,$filename);
        } else {
            $filename = 'image-not-found.png';
        }
        $prod->product = $request->input('product');
        $prod->price = $request->input('price');
        $prod->categoryid = $request->input('categoryid');
        $prod->description = $request->input('description');
        $prod->image = $filename;
        $prod->save();
        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $path = public_path().'/uploads/';
        if ($product->image != 'image-not-found.png') {
            File::delete($path.$product->image);
        }
        $product->delete();
    }
    public function cart(Request $request){
        $products = DB::table('products')->whereIn('id',$request)->get();
        return response()->json($products);
    }
    public function category(Request $request, $id){
        $cate = Product::where('categoryid',$id)->get();
        return response()->json($cate);
    }
}
