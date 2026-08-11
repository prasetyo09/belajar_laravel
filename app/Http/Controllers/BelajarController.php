<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index()
    {
        return view("counting");
    }
    public function indexTambah()
    {
        return view("tambah");
    }
    public function indexKurang()
    {
        return view("kurang");
    }
    public function indexKali()
    {
        return view("kali");
    }
    public function indexBagi()
    {
        return view("bagi");
    }
    public function greeting()
    {
        return "Saya Akan Lawan!!!";
    }

    public function tambah(Request $request)
    {
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $hasilTambah = $angka1 + $angka2;
        return view('tambah', compact('hasilTambah'));
    }
    public function kurang(Request $request)
    {
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $hasilKurang = $angka1 - $angka2;
        return view('kurang', compact('hasilKurang'));
    }
    public function kali(Request $request)
    {
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $hasilKali = $angka1 * $angka2;
        return view('kali', compact('hasilKali'));
    }
    public function bagi(Request $request)
    {
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $hasilBagi = $angka1 / $angka2;
        return view('bagi', compact('hasilBagi'));
    }
}
