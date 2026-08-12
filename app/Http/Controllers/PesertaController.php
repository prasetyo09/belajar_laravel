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
        $subtitle = "Pusat Pelatihan Kerja Daerah Jakarta Pusat";
        return view('peserta.index', compact('pesertas', 'title', 'subtitle'));
    }

    public function create()
    {
        $title = "Tambah Peserta Baru";
        $subtitle = "Pusat Pelatihan Kerja Daerah Jakarta Pusat";
        return view('peserta.create', compact('title', 'subtitle'));
    }

    public function edit(string $id)
    {
        $peserta = Peserta::find($id);
        $title = "Edit Peserta";
        return view('peserta.edit', compact('title', 'peserta'));
    }
    public function title()
    {
        return "Data Peserta Baru";
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:pesertas,email',
            'age' => 'required',
            'address' => 'nullable'
        ]);
        Peserta::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'address' => $request->address
        ]);

        return redirect()->to('peserta');
    }

    public function update(string $id, Request $request)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->name = $request->name;
        $peserta->email = $request->email;
        $peserta->age = $request->age;
        $peserta->address = $request->address;
        $peserta->save();

        // $peserta->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'age' => $request->age,
        //     'address' => $request->address
        // ]);

        return redirect()->to('peserta');
    }

    public function delete(string $id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();

        return redirect()->to('peserta');
    }
}
