<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Panel de Administración
        </h2>
    </x-slot>

    <div class="p-6 text-white">
        Bienvenido {{ auth()->user()->name }}
        <p>Rol: {{ auth()->user()->getRoleNames()->first() }}</p>
        @role('admin')
            <a href="/productos">Administrar Productos</a>
        @endrole
        @hasanyrole('admin|vendedor')
            <p>Zona de ventas</p>
        @endhasanyrole

    </div>


</x-app-layout>
