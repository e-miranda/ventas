<x-app-layout>
@php
    
    $estados = [
        App\Models\Venta::PENDIENTE => ['Pendiente', 'bg-yellow-900 text-yellow-200'],
        App\Models\Venta::APROBADA  => ['Aprobada',  'bg-green-100 text-green-800'],
        App\Models\Venta::RECHAZADA => ['Rechazada', 'bg-red-100 text-red-800'],
        App\Models\Venta::ENTREGADA => ['Entregada', 'bg-blue-100 text-blue-800'],
    ];
@endphp

<x-slot name="header">
    <h2 class="text-xl font-semibold text-white">
        Estado de la Venta #{{ $venta->id }}
    </h2>
</x-slot>

<div class="bg-gray-800 p-6 rounded shadow text-white">

    <p><strong>Producto:</strong> {{ $venta->producto->nombre }}</p>
    <p><strong>Cantidad:</strong> {{ $venta->cantidad }}</p>
    <p><strong>Total:</strong> Bs {{ number_format($venta->precio * $venta->cantidad, 2) }}</p>

    <div class="mt-3">
        <span class="px-3 py-1 rounded text-sm {{ $estados[$venta->estado][1] }}">
            {{ $estados[$venta->estado][0] }}
        </span>
    </div>

    {{-- Comprobante --}}
    @if ($venta->imagen)
        <div class="mt-4">
            <p class="font-semibold">Comprobante:</p>
            <img src="{{ asset('storage/'.$venta->imagen) }}" class="w-64 border rounded">
        </div>
    @endif

    {{-- Mensaje por estado --}}
    <div class="mt-4">
        @if ($venta->estado === \App\Models\Venta::PENDIENTE)
            <div class="alert alert-warning">
                Pago en revisión.
            </div>
        @elseif ($venta->estado === \App\Models\Venta::APROBADA)
            <div class="alert alert-success">
                Pago aprobado. Preparando entrega.
            </div>
        @elseif ($venta->estado === \App\Models\Venta::RECHAZADA)
            <div class="alert alert-danger">
                Pago rechazado.
            </div>
        @elseif ($venta->estado === \App\Models\Venta::ENTREGADA)
            <div class="alert alert-primary">
                Pedido entregado.
            </div>
        @endif
    </div>

    {{-- QR --}}
    @if ($venta->qr)
        <div class="mt-4">
            <p class="font-semibold">Código QR</p>
            <img src="{{ asset('storage/'.$venta->qr) }}" width="200">
        </div>
    @endif

    {{-- Acciones administrativas --}}
    @auth
    <div class="mt-6 flex gap-3">
        

        @if ($venta->puedeAprobar())
            <form method="POST" action="{{ route('ventas.aprobar', $venta) }}">
                @csrf
                @method('PUT')
                <button class="px-4 py-2 
                            bg-green-600 text-white 
                            border border-green-300
                            rounded shadow-lg
                            hover:bg-green-700
                            transition">
                        Aprobar
                </button>

            </form>
        @endif

        @if ($venta->puedeRechazar())
            <form method="POST" action="{{ route('ventas.rechazar', $venta) }}">
                @csrf
                @method('PUT')
                <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Rechazar
                </button>
            </form>
        @endif

        @if ($venta->puedeEntregar())
            <form method="POST" action="{{ route('ventas.entregar', $venta) }}">
                @csrf
                @method('PUT')
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Entregar
            </button>

            </form>
        @endif



    </div>

    @endauth
    @if ($venta->historial->count())
        <div class="mt-8 bg-black text-white p-4 rounded">
            <h3 class="font-semibold mb-3">Historial de Estados</h3>

            <ul class="space-y-2 text-sm">
                @foreach ($venta->historial as $item)
                    <li class="border-b border-gray-700 pb-2">
                        {{ $item->created_at->format('d/m/Y H:i') }} —
                        {{ $venta->estadoTexto() }}
                        @if ($item->user)
                            ({{ $item->user->name }})
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif


</div>
</x-app-layout>
