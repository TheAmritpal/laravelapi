<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\order;
use App\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $details = new OrderDetail;
        $details->orderId = $request->input('orderId');
        $details->productId = $request->input('productId');
        $details->quantity = $request->input('quantity');
        $details->save();
        return response()->json(['details'=>$details]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = DB::table('orders_details')
        ->join('orders','orders_details.orderId','=','orders.id')
        ->join('products','orders_details.productId','=','products.id')
        ->select('products.product','quantity')
        ->where('orders.id','=',$id)
        ->get();
        return response()->json($details);
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
}
