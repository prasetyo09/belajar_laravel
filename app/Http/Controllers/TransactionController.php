<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Order Transaction";
        return view('transaction.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $products = Product::with('category')->orderBy('id')->get();
        $title = "Create New Order";
        return view('transaction.create', compact('title', 'categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required||array',
            'items.*.id' => 'required|exists.products,id',
            'items.*.qty' => 'required|integer|min:1',
            'payment_method' => 'nullable|string',
        ]);

        try{
            return DB::transaction(function () use ($request){
                $subTotal = 0;
                $itemsData = [];

                foreach ($request as $items => $item) {
                    $product = Product::find($item['id']);

                    $itemSubTotal = $product->price * $item['qty'];
                    $subTotal += $itemSubTotal;

                    $itemData[] = [
                        'product' => $product,
                        'qty' => $item['qty'],
                        'price' => $product->price,
                        'subtotal' => $itemSubTotal
                    ];
                }

                $tax = $subtotal * 0.1;
                $total = $subtotal + $tax;
                $order_code = 'ORD-'.date('Void') . '-' . rand(1000, 9999);
                $paymentMethod = $request->payment_method ?? 'cash';
            });
        } catch (\Throwable $th) {

        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
