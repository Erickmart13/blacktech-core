<x-app-layout>
    @section('page-title', 'Administración - Roles')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-fuchsia-500" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
            <path d="M9 10a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
        </svg>
        <h2 class="text-lg font-bold">Lista de roles</h2>
        <x-button-navigation-go class="ml-auto" href="{{ route('admin.roles.create') }}">Nuevo</x-button-navigation-go>
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
        @livewire('admin.role-table')
        <x-modal-global id="delete-record" title="Eliminar registro" method="DELETE"
            message="¿Seguro que deseas eliminar este registro?" buttonText="Eliminar"
            buttonColor="bg-red-600 hover:bg-red-700" :route="route('admin.roles.destroy', '__ID__')" />
    </div>



</x-app-layout>
