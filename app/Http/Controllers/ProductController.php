<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Models\Catagorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Picqer;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product=Product::paginate();
        return view('product.index',["products"=>$product],["catagories"=>Catagorie::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    $product=new Product();
       
        if ($request->hasFile('product_image')) {
            $file=$request->file('product_image');
            $file->move(public_path().'/product/img',$file->getClientOriginalName());
            $product_image=$file->getClientOriginalName();
            $product->product_image=$product_image;
        }
        $product_code=$request->product_code;
        $redColor='255,0,0';
        $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
        file_put_contents('product/barcode/'.$product_code.'.jpg',
        $generator->getBarcode( $product_code, $generator::TYPE_CODE_128,2,40));
        
        $product->product_name=$request->product_name;
        $product->product_code=$product_code;
         $unique=Product::where('product_code',$product_code)->first();
        if ($unique) {
            return redirect()->back()->with('message','product Code Already Taken');
        }
        $product->barcode=$product_code .'.jpg';
        $product->product_catagorie=$request->product_catagorie;
        $product->bay_price=$request->price;
        $product->sell_price=$request->sell_price;
        $product->quantity=$request->quantity;
        
        $product->alert_stock=$request->alert_stock;
        $product->save();
        return redirect()->back()->with('massage','Product Add  Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if ($request->hasFile('product_image')) {

            if ($product->product_image != '') {
                $proImg_path = public_path().'/product/img/' . $product->product_image;
                if (file_exists($proImg_path)) {
                    unlink($proImg_path);
                }
            }

            $file=$request->file('product_image');
            $file->move(public_path().'/product/img',$file->getClientOriginalName());
            $product_image=$file->getClientOriginalName();
            $product->product_image=$product_image;
        }
        
        $product_code = $request->product_code;
        $unique=Product::where('product_code',$product_code)->first();
       
        
        if ($product_code != '' && $product_code != $product->product_code) {
            if ($product->barcode != '') {
                $barcode_path = public_path().'/product/barcode/' . $product->barcode;
                if (file_exists($barcode_path)) {
                    unlink($barcode_path);
                }
            }
            $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
            file_put_contents('product/barcode/' . $product_code . '.jpg', $generator->getBarcode($product_code, $generator::TYPE_CODE_128, 3, 50));
            
            $product->product_code = $product_code;
            $product->barcode = $product_code . '.jpg';
        }
        
        $product->product_name = $request->product_name;
        $product->product_catagorie = $request->product_catagorie;
        $product->bay_price = $request->bay_price;
        $product->sell_price = $request->sell_price;
        $product->quantity = $request->quantity;
        $product->alert_stock = $request->alert_stock;
        $product->update();
        return back()->with('message','product update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
       
        $product->delete();
        return back()->with('message','product delete successfully');
    }

    public function getBarCode()
    {
       
        $product=Product::all();
        return view('product.barcode',["products"=>$product]);
    }
    
    public function search(Request $request)
{
    $query = $request->get('query');
    $products = Product::where('product_code','product_name',  'LIKE', "%{$query}%")
                       ->get(['id', 'product_name', 'sell_price','product_code']);
    return response()->json($products);
}

}
