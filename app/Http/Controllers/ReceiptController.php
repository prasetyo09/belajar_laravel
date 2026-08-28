<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function printReceipt($id){
        $transaction = Transaction::with('items')->findOrFail($id);

        // 2. Hitung jumlah item dengan aman
        // optional() & count() memastikan tidak akan error meski items bernilai null atau belum terisi
        $itemCount = isset($transaction->items) && $transaction->items instanceof \Countable
            ? $transaction->items->count()
            : 1;

        // Pastikan minimal tinggi tetap dihitung untuk 1 baris
        $itemCount = max($itemCount, 1);

        // 3. Hitung dimensi kertas (80mm = ~226.77 pt)
        $paperWidth = 226.77;
        $baseHeight = 220;
        $totalHeight = $baseHeight + ($itemCount * 25);

        // 4. Render PDF struk
        $pdf = Pdf::loadView('receipt.thermal', compact('transaction'))->setPaper([0, 0, $paperWidth, $totalHeight], 'portrait');

        return $pdf->stream('struk-' . $transaction->order_code . '.pdf');
    }
}
