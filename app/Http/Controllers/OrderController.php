<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Order_Detail;
use App\Models\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;
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
            
            $orders->save();
            $order_id=$orders->id;

            for ($i = 0; $i < count($request->product_id); $i++) {
                $product = Product::findOrFail($request->product_id[$i]);

                // Check if sufficient quantity is available
                if ($product->quantity < $request->quantity[$i]) {
                    DB::rollBack();
                    $message = 'Insufficient stock for product: ' . $product->product_name;
                    Log::error($message);
                    return back()->withErrors(['error' => $message])->withInput();
                }

                // Update the product quantity
                $product->quantity -= $request->quantity[$i];
                $product->save();

                // Create order details
                $order_details = new Order_Detail();
                $order_details->order_id = $order_id;
                $order_details->product_id = $request->product_id[$i];
                $order_details->quantity = $request->quantity[$i];
                $order_details->unitprice = $request->price[$i];
                $order_details->amount = $request->total_amount[$i];
                $order_details->discount = $request->discount[$i];
                $order_details->save();
            }


            $transaction= new Transaction();
            $transaction->order_id=$order_id;
            $transaction->paid_amount=$request->paid_amount;
            $transaction->balance=$request->balance;
            $transaction->payment_method=$request->payment_method;
            $transaction->user_id=auth()->user()->id;
            $transaction->transac_date=date('y-m-d');
            $transaction->transac_amount=$order_details->amount;
            $transaction->save();


           
                });

                return redirect()->back()->with('message', 'Order created and product stock updated successfully!');
                


        
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