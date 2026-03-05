<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar Producto</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('productos.update',$producto) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <input type="text" name="nombre" value="{{ $producto->nombre }}" class="w-full border p-2 mb-2">
            <input type="number" name="cantidad" value="{{ $producto->cantidad }}" class="w-full border p-2 mb-2">
            <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" class="w-full border p-2 mb-2">
            <input type="number" step="0.01" name="costo_unitario" value="{{ $producto->costo_unitario }}" class="w-full border p-2 mb-2">

            <select name="estado" class="w-full border p-2 mb-2">
                <option value="activo" @selected($producto->estado=='activo')>Activo</option>
                <option value="inactivo" @selected($producto->estado=='inactivo')>Inactivo</option>
            </select>

            <input type="file" name="imagen" class="w-full mb-4">

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
