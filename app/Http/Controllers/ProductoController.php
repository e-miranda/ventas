<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nombre' => 'required',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'costo_unitario' => 'required|numeric',
            'imagen' => 'nullable|image'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos','public');
        }

        Producto::create($data);

        return redirect()->route('productos.index')
            ->with('success','Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
       return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'costo_unitario' => 'required|numeric',
            'imagen' => 'nullable|image'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('productos','public');
        }

        $producto->update($data);

        return redirect()->route('productos.index')
            ->with('success','Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
         if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);            
        }

        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success','Producto eliminado');
    }
}
