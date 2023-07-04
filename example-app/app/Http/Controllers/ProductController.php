<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $allproducts =$product->all();
        // dd($allproduct);
        return view("allproducts",compact('allproducts'));
    }

    public function adminallproducts(Product $product)
    {
        $allproducts =$product->all();
        return view("admin.adminallproducts",compact('allproducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("addnewproduct");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Product $product)
    {
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_price;
        $product->product_quantity = $request->product_quantity;
        $product->save();
        return redirect("productpage");
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
    public function edit(Product $product,$id)
    {
        $productDataByID=$product::find($id);
        return view("addnewproduct",compact('productDataByID'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product,$id)
    {
        $productDataByID = Product::find($id);
        $productDataByID->product_title = $request->product_title ;
        $productDataByID->product_description=$request->product_description ;
        $productDataByID->product_price=$request->product_price ;
        $productDataByID->product_quantity=$request->product_quantity;
        $productDataByID->save();
        return redirect("adminallproducts");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,Product $product)
    {
       $productDataByID=$product::find($id);
       $productDataByID->delete();
        return redirect("adminallproducts");
    }
}
