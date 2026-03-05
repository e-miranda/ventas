<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">
            Listado de Ventas
        </h2>
    </x-slot>

    <div class="p-6">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">ID</th>
                    <th class="border px-3 py-2">Producto</th>
                    <th class="border px-3 py-2">Comprador</th>
                    <th class="border px-3 py-2">Cantidad</th>
                    <th class="border px-3 py-2">Total</th>
                    <th class="border px-3 py-2">Estado</th>
                    <th class="border px-3 py-2">Comprobante</th>
                    <th class="border px-3 py-2">Acción</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($ventas as $venta)
                    <tr class="text-center  text-white">
                        <td class="border px-2 py-1">{{ $venta->id }}</td>
                        <td class="border px-2 py-1">{{ $venta->producto->nombre }}</td>
                        <td class="border px-2 py-1">{{ $venta->nombre_comprador }}</td>
                        <td class="border px-2 py-1">{{ $venta->cantidad }}</td>
                        <td class="border px-2 py-1">
                            Bs {{ number_format($venta->precio * $venta->cantidad, 2) }}
                        </td>

                        <td class="border px-2 py-1">
                            @php
                                $colores = [
                                    0 => 'bg-yellow-100 text-yellow-800',
                                    1 => 'bg-green-100 text-green-800',
                                    2 => 'bg-red-100 text-red-800',
                                    3 => 'bg-blue-100 text-blue-800',
                                ];
                            @endphp

                            <span class="px-2 py-1 rounded text-sm {{ $colores[$venta->estado] }}">
                                {{ match($venta->estado) {
                                    0 => 'Pendiente',
                                    1 => 'Aprobada',
                                    2 => 'Rechazada',
                                    3 => 'Entregada'
                                } }}
                            </span>
                        </td>

                        <td class="border px-2 py-1">
                            @if ($venta->imagen)
                                <a href="{{ asset('storage/'.$venta->imagen) }}" target="_blank"
                                   class="text-blue-600 underline">
                                    Ver imagen
                                </a>
                            @endif
                        </td>

                        <td class="border px-2 py-1 space-x-1">
                            @if ($venta->estado === \App\Models\Venta::PENDIENTE)
                                <form action="{{ route('ventas.aprobar', $venta) }}" method="POST" class="inline" >
                                    @csrf                                    
                                    @method('PUT')
                                    <button class="px-2 py-1 
                            bg-green-600 text-white 
                            border border-green-300
                            rounded shadow-lg
                            hover:bg-green-700
                            transition">
                                        Aprobar
                                    </button>
                                </form>

                                <form action="{{ route('ventas.rechazar', $venta) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="bg-red-600 text-white px-2 py-1 rounded text-sm">
                                        Rechazar
                                    </button>
                                </form>                                
                            @endif

                            @if ($venta->estado === \App\Models\Venta::APROBADA)
                                <form action="{{ route('ventas.entregar', $venta) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="bg-blue-600 text-white px-2 py-1 rounded text-sm">
                                        Entregar
                                    </button>
                                </form>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
