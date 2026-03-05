<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use App\Services\QrService;
use App\Models\VentaEstado;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;


class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('producto')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ventas.index', compact('ventas'));
    }

    public function aprobar(Venta $venta)
    {
       abort_unless($venta->puedeAprobar(), 403, 'La venta no puede ser aprobada');

        DB::transaction(function () use ($venta) {

            VentaEstado::create([
                'venta_id'        => $venta->id,
                'estado_anterior' => $venta->estado,
                'estado_nuevo'    => Venta::APROBADA,
                'user_id'         => auth()->id(),
            ]);

            $venta->update([                 
                'autorizacion' => 'aprobada',
                'estado' => Venta::APROBADA,
            ]);
        });

        return redirect()
            ->route('ventas.index')
            ->with('success', 'Venta aprobada correctamente');
    }
    
    //estado de la venta
    public function estado(Venta $venta)
    {
        $venta->load('historial.user');
        return view('ventas.estado', compact('venta'));

    }

    public function rechazar(Venta $venta)
    {
        abort_unless($venta->puedeRechazar(), 403);
        DB::transaction(function () use ($venta) {
            VentaEstado::create([
                'venta_id'        => $venta->id,
                'estado_anterior' => $venta->estado,
                'estado_nuevo'    => Venta::RECHAZADA,
                'user_id'         => auth()->id(),
            ]);
            $venta->update([
                'estado' => Venta::RECHAZADA,
                'autorizacion' => 'rechazada',
            ]);
        });

        return back()->with('success', 'Venta rechazada');
    }

    public function crear()
    {
        $productos = Producto::where('estado', 'activo')
            ->where('cantidad', '>', 0)
            ->get();

        return view('ventas.crear', compact('productos'));
    }

    public function store(Request $request)
    {
        
        $producto = Producto::findOrFail($request->id_producto);
        // Verificar stock
        if($request->cantidad > $producto->cantidad){
            return redirect()->back()->withErrors(['cantidad' => 'No hay suficiente stock']);
        }    
         // Crear venta        
        $venta = Venta::create([
            'producto_id' => $producto->id,
            'cantidad' => $request->cantidad,
            'precio' => $producto->precio * $request->cantidad,
            'autorizacion' => 'pendiente',
            'estado' => Venta::PENDIENTE,
            'imagen' => $producto->imagen,
            'telefono' => $request->telefono,
            'nombre_comprador' => $request->nombre_comprador,
            'email_deposito' => $request->email_deposito,
            'habilitado' => 1
        ]);
        if ($request->hasFile('imagen')) {
                $venta->imagen = $request->file('imagen')->store('comprobantes', 'public');
               // $venta->save();
        }

        $request->validate([
            'id_producto' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'nombre_comprador' => 'required|string|max:255',
            'email_deposito' => 'nullable|email',
        ]);
 
        // Actualizar stock del producto
        $producto->cantidad -= $request->cantidad;
        $producto->save();

        // Generar QR automáticamente
        $datosQR = [
            'banco' => 'UNION',
            'cuenta' => '123456789', // reemplazar con cuenta real
            'monto' => number_format($venta->precio, 2, '.', ''),
            'ref' => $venta->id,
            'comprador' => $venta->nombre_comprador
        ];

        $rutaQR = QrService::generar($datosQR, 'venta_'.$venta->id);
        $venta->qr = $rutaQR;
        $venta->save();

     //   return redirect()->route('ventas.show', $venta)->with('success', 'Venta registrada y QR generado.');

        return redirect()->route('ventas.estado', $venta)
    ->with('success', 'Compra registrada. Guarda este número para consultar tu estado.');
    }
    
    public function entregar(Venta $venta)
    {
        abort_unless($venta->puedeEntregar(), 403);

        DB::transaction(function () use ($venta) {

            VentaEstado::create([
                'venta_id'        => $venta->id,
                'estado_anterior' => $venta->estado,
                'estado_nuevo'    => Venta::ENTREGADA,
                'user_id'         => auth()->id(),
            ]);

            $venta->update([
                'estado' => Venta::ENTREGADA,
            ]);
        });

        return back()->with('success', 'Producto entregado');
    }

    public function show(Venta $venta)
    {
        return view('ventas.show', compact('venta'));
    }
}
