<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">Catálogo de Producto</h2>
    </x-slot>    

    <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($productos as $producto)
            <div class="border rounded-lg shadow hover:shadow-lg transition bg-white">
                <a href="{{ route('catalogo.show', $producto) }}">
                    @if($producto->imagen)
                        <img src="{{ asset('storage/'.$producto->imagen) }}" class="w-full h-48 object-cover rounded-t w-">
                    @endif
                </a>

                <div class="p-4">
                    <h3 class="font-semibold text-lg">{{ $producto->nombre }}</h3>
                    <p class="text-gray-600 text-sm mb-2">Stock: {{ $producto->cantidad }}</p>
                    <p class="text-xl font-bold mb-3">Bs {{ number_format($producto->precio,2) }}</p>

                    <a href="{{ route('catalogo.show', $producto) }}"
                       class="block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                        Ver / Comprar
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    
</x-app-layout>
