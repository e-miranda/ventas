@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Detalle de Venta #{{ $venta->id }}</h2>

    <p><strong>Producto:</strong> {{ $venta->producto->nombre }}</p>
    <p><strong>Cantidad:</strong> {{ $venta->cantidad }}</p>
    <p><strong>Precio Total:</strong> Bs {{ number_format($venta->precio, 2) }}</p>
    <p><strong>Comprador:</strong> {{ $venta->nombre_comprador }}</p>
    <p><strong>Teléfono:</strong> {{ $venta->telefono }}</p>
    <p><strong>Email depósito:</strong> {{ $venta->email_deposito }}</p>

    @if($venta->qr)
        <h3 class="mt-4 mb-2 font-semibold">QR para pago:</h3>
        <img src="{{ asset('storage/' . $venta->qr) }}" alt="QR de pago" class="w-64 h-64">
    @endif

    <a href="{{ route('ventas.crear') }}" class="mt-4 inline-block bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
        Registrar otra venta
    </a>
</div>
@endsection
