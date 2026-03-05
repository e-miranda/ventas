<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CatalogoController extends Controller
{
     public function index()
    {
        $productos = Producto::where('estado', 'activo')
            ->where('cantidad', '>', 0)
            ->orderBy('id', 'desc')
            ->get();

        return view('catalogo.index', compact('productos'));
    }

    public function show(Producto $producto)
    {
        return view('catalogo.show', compact('producto'));
    }
}
