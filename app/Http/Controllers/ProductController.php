<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        $title = "Product Data";
        return view('product.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $title = "Create New Product";
        return view('product.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =[
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description
        ];
        //Jika user upload foto
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->to('product')->with('success', 'Create Product Success');
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
    public function edit(string $id)
    {
        $categories = Category::get();
        $products = Product::find($id);
        $title = "Edit Product";
        return view('product.edit', compact('title', 'products', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data =[
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description
        ];

        if($request->hasFile('photo'))
        {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }

            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->to('product')->with('success', 'Update Product Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->photo);
        $product->delete();
        return redirect()->to('product');
    }
}
