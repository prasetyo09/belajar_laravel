<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;

class PesertaController extends Controller
{
    public function index()
    {
        //SELECT * FROM pesertas
        $pesertas = Peserta::get();
        $title = "Data Peserta Baru";
        return view('peserta.index', compact('pesertas', 'title'));
    }

    public function create()
    {
        $title = "Tambah Peserta Baru";
        return view('peserta.create', compact('title'));
    }
    public function title()
    {
        return "Data Peserta Baru";
    }

    public function store(Request $request)
    {
        Peserta::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'address' => $request->address
        ]);

        return redirect()->to('peserta');
    }
}
