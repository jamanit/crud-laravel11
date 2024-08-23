<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::get();

        return view('product.index_product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create_product');
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Products $product)
    {
        $request->validate([
            'product_code' => 'required|string|max:20|unique:products',
            'product_name' => 'required|string|max:255',
            'price'        => 'required|numeric',
            'stock'        => 'required|integer',
        ]);

        $product->create($request->all());

        return redirect()->route('products.index')->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        return view('product.edit_product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price'        => 'required|numeric',
            'stock'        => 'required|integer',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Data deleted successfully');
    }
}
