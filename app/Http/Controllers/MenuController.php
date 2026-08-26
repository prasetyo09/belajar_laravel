<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function sidebar(){
        $menus = Menu::all();

        return view ('app', compact('menus'));
    }
    public function index()
    {
        $menus = Menu::orderBy('id', 'DESC')->get();
        $title = "Menu Page";
        return view('menu.index', compact('title', 'menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add to Menu';
        return view('menu.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'parent_id' => 'nullable|exists:menus,id',
            'name' => 'required|string',
            'icon' => 'required|string',
            'url' => 'required|string|max:88',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean'
        ]);
        
        Menu::create([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'icon' => $request->icon,
            'url' => $request->url,
            'sort_order' => $request->sort_order,
            'is_active' => $request->is_active
        ]);

        return redirect()->to('menu');
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
        $menus = Menu::find($id);
        $title = "Edit Menu";
        return view('menu.edit', compact('title', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->update([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'icon' => $request->icon,
            'url' => $request->url,
            'sort_order' => $request->sort_order,
            'is_active' => $request->is_active
        ]);

        return redirect()->to('menu');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Menu::findOrFail($id)->delete();
        return redirect()->to('menu');
    }
}
