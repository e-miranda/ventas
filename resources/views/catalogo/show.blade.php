<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">{{ $producto->nombre }}</h2>
    </x-slot>

    <div class="p-6 max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 text-white">
        <div>
            @if($producto->imagen)
                <img src="{{ asset('storage/'.$producto->imagen) }}" class="w-30 rounded shadow">
            @endif
        </div>

        <div>
            <h3 class="text-2xl font-bold mb-2">{{ $producto->nombre }}</h3>

            <p class=" mb-2">Disponible: {{ $producto->cantidad }} unidades</p>

            <p class="text-3xl font-bold mb-4">Bs {{ number_format($producto->precio,2) }}</p>

            <div class="mb-4">
                <label class="block mb-1 text-black">Cantidad a comprar</label>
                <input type="number" id="cantidad"
                       min="1"
                       max="{{ $producto->cantidad }}"
                       value="1"
                       class="border p-2 rounded w-32">
            </div>

            <a href="{{ route('ventas.crear', $producto) }}"
               class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 transition inline-block">
                Comprar Ahora
            </a>
        </div>
    </div>
</x-app-layout>
