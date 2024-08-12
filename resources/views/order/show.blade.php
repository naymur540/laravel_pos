<!-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Order Details</h4>
        </div>
        <div class="card-body">
            <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Order Details:</strong></p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Discount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ number_format($detail->unitprice, 2) }}</td>
                            <td>{{ $detail->discount }}%</td>
                            <td>{{ number_format($detail->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection -->




<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Order_Detail;
use App\Models\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $orders = Order::all();
        
       
        $order_receipts = Order_Detail::whereIn('order_id', $orders->pluck('id'))->get();
    
        return view('order.index', [
            "orders" => $orders,
            "products" => $products,
            "order_receipt" => $order_receipts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product=Product::all();
        $order=Order::all();
        $lastId=Order_Detail::max('order_id');
        $order_receipt = Order_Detail:: where('order_id', $lastId)->get();
        return view('order.create',
        ["orders"=>$order,
        "products"=>$product,
       "order_receipt"=>$order_receipt
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        
        DB::transaction(function() use($request) {
            $orders=new Order();
    
            $orders->name= $request->customer_name;
            $orders->phone= $request->customer_phone;
            $orders->total=$request->total;
            $orders->save();
            $order_id=$orders->id;

            for ($product_id=0; $product_id <count($request->product_id) ; $product_id++) { 
                $order_details= new Order_Detail();
                $order_details->order_id=$order_id;
                $order_details->product_id=$request->product_id[$product_id];
                $order_details->quantity=$request->quantity [$product_id];
                $order_details->unitprice=$request->price [$product_id];
                $order_details->amount=$request->total_amount [$product_id];
                $order_details->discount=$request->discount [$product_id];
                $order_details->save();
            };


            $transaction= new Transaction();
            $transaction->order_id=$order_id;
            $transaction->paid_amount=$request->paid_amount;
            $transaction->balance=$request->balance;
            $transaction->payment_method=$request->payment_method;
            $transaction->user_id=auth()->user()->id;
            $transaction->transac_date=date('y-m-d');
            $transaction->transac_amount=$order_details->amount;
            $transaction->save();


            $products = Product::all();
            $order_details = Order_Detail:: where('order_id', $order_id)->get();
            $orderedBy =Order:: where('id', $order_id)->get();
            return view('order.index',
            [
            'products'=> $products,
            'order_details'=>$order_details,
             'customer_orders' => $orderedBy
            ]);
                });
                return back()->with("Product orders Fails to inserted! check your inputs!");

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
    public function report() {
        $products = Product::all();
        $orders = Order::all();
        
       
        $order_receipts = Order_Detail::whereIn('order_id', $orders->pluck('id'))->get();
    
        return view('order.show', [
            "orders" => $orders,
            "products" => $products,
            "order_receipt" => $order_receipts
        ]);
    }
    
}