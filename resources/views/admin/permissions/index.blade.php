<x-app-layout>
    @section('page-title', 'Administración - Roles')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-fuchsia-500" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-user-check">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
            <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
            <path d="M15 19l2 2l4 -4" />
        </svg>
        <h2 class="text-lg font-bold">Lista de Permisos</h2>
        <x-button-global class="ml-auto" href="{{ route('system.permissions.create') }}">Nuevo</x-button>
    </div>

    <div class="border-2 p-2 lg:mx-5 shadow-xl">
        @if (session()->has('success'))
            <x-alert type="success" :message="session('success')" />
        @endif
        @if (session()->has('error'))
            <x-alert type="error" :message="session('error')" />
        @endif
        @if (session()->has('warning'))
            <x-alert type="warning" :message="session('warning')" />
        @endif
        @livewire('admin.permission-table')
        <x-modal-global id="delete-record" title="Eliminar Rol" message="¿Seguro que deseas eliminar este rol?"
            :route="route('system.permissions.destroy', '__ID__')" />
    </div>



</x-app-layout>
