<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Midtrans\Config;

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
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'payment_method' => 'nullable|string'
        ]);

        try {
            return DB::transaction(function () use ($request) {
                $subTotal = 0;
                $itemsData = [];

                foreach ($request->items as $item) {
                    $product = Product::findOrFail($item['id']);

                    if ($product->qty < $item['qty']) {
                        throw new Exception("Stok produk '{$product->name}' tidak mencukupi.");
                    }

                    $itemSubTotal = $product->price * $item['qty'];
                    $subTotal += $itemSubTotal;

                    $itemsData[] = [
                        'product' => $product,
                        'qty' => $item['qty'],
                        'price' => $product->price,
                        'subtotal' => $itemSubTotal
                    ];
                }

                $tax = $subTotal * 0.1;
                $total = $subTotal + $tax;
                $order_code = 'ORD-' . date('Ymd') . '-' . rand(1000, 9999);
                $paymentMethod = $request->payment_method ?? 'cash';

                $order = Transaction::create([
                    'order_code' => $order_code,
                    'order_amount' => $total,
                    'order_change' => $request->order_change,
                    'status' => $paymentMethod === 'cash' ? 'success' : 'pending'
                ]);

                foreach ($itemsData as $data) {
                    TransactionDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $data['product']->id,
                        'order_qty'   => $data['qty'],
                        'order_price' => $data['price'],
                        'order_subtotal' => $data['subtotal']
                    ]);

                    if ($paymentMethod === 'cash') {
                        $data['product']->decrement('qty', $data['qty']);
                    }
                }

                if ($paymentMethod === 'midtrans') {
                    Config::$serverKey    = config('services.midtrans.server_key');
                    Config::$isProduction = config('services.midtrans.is_production');
                    Config::$isSanitized  = true;
                    Config::$is3ds        = true;

                    // foreach ($itemsData as $data) {
                    //     TransactionDetail::create([
                    //         'order_id' => $order->id,
                    //         'product_id' => $data['product']->id,
                    //         'order_qty'   => $data['qty'],
                    //         'order_price' => $data['price'],
                    //         'order_subtotal' => $data['subtotal']
                    //     ]);

                    //     $data['product']->decrement('qty', $data['qty']);
                    // }

                    $params = [
                        "transaction_details" => [
                            "order_id" => $order->order_code,
                            "gross_amount" => (int) round($total)
                        ],
                        "customer_details" => [
                            "first_name" => $request->customer_name ?? 'No-Name',
                            "email" => $request->customer_email ?? 'No-Email',
                            "address" => $request->customer_address ?? 'No-Address'
                        ],
                        // 'enabled_payments' => ['gopay', 'qris']
                    ];

                    $snapToken = Snap::getSnapToken($params);

                    return response()->json([
                        'success' => true,
                        'payment_method' => 'midtrans',
                        'snap_token' => $snapToken,
                        'order_id' => $order->id
                    ]);

                }
                return response()->json([
                    'success' => true,
                    'payment_method' => $paymentMethod,
                    'order_id' => $order->id
                ]);
            });
        } catch (Exception $th) {
            return response()->json([
                'message' => 'GAGAL MENYIMPAN TRANSAKSI!!! ' . $th->getMessage()
            ], 400);
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
