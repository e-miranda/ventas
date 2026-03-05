<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nuevo Producto</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="nombre" placeholder="Nombre" class="w-full border p-2 mb-2">
            <input type="number" name="cantidad" placeholder="Cantidad" class="w-full border p-2 mb-2">
            <input type="number" step="0.01" name="precio" placeholder="Precio" class="w-full border p-2 mb-2">
            <input type="number" step="0.01" name="costo_unitario" placeholder="Costo unitario" class="w-full border p-2 mb-2">

            <select name="estado" class="w-full border p-2 mb-2">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>

            <input type="file" name="imagen" class="w-full mb-4">

            <button class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
