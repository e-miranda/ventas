<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">
            Registrar Venta
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('ventas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Seleccionar Producto -->
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-white">Producto</label>
                <select name="id_producto" class="border p-2 w-full rounded" required>
                    <option value="">Seleccione un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}">
                            {{ $producto->nombre }}
                            (Stock: {{ $producto->cantidad }})
                            - Bs {{ number_format($producto->precio, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Cantidad -->
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-white">Cantidad</label>
                <input type="number" name="cantidad"
                       class="border p-2 w-full rounded"
                       min="1" value="1" required>
            </div>

            <!-- Datos del Comprador -->
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-white">Nombre del comprador</label>
                <input type="text" name="nombre_comprador"
                       class="border p-2 w-full rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold text-white">Teléfono</label>
                <input type="text" name="telefono"
                       class="border p-2 w-full rounded">
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-white">Comprobante</label>
                <input type="file" name="imagen" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold text-white">Email de depósito</label>
                <input type="email" name="email_deposito"
                       class="border p-2 w-full rounded">
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Registrar Venta
            </button>
        </form>

    </div>

</x-app-layout>
