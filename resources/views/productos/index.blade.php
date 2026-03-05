<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">Productos</h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('productos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Nuevo Producto</a>

        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Imagen</th>
                    <th class="p-2">Nombre</th>
                    <th class="p-2">Cantidad</th>
                    <th class="p-2">Precio</th>
                    <th class="p-2">Estado</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr class="border-b ">
                    <td class="p-2 ">
                        @if($producto->imagen)
                            <img src="{{ asset('storage/'.$producto->imagen) }}" class="w-16">
                        @endif
                    </td>
                    <td class="p-2 text-white">{{ $producto->nombre }}</td>
                    <td class="p-2  text-white">{{ $producto->cantidad }}</td>
                    <td class="p-2  text-white">Bs {{ $producto->precio }}</td>
                    <td class="p-2  text-white">{{ $producto->estado }}</td>
                    <td class="p-2">
                        <a href="{{ route('productos.edit',$producto) }}" class="bg-blue-600 text-white px-4 py-2 rounded">Editar</a>
                        <form action="{{ route('productos.destroy',$producto) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="bg-red-600 text-white px-4 py-2 rounded">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
