<x-app-layout>
    @section('page-title', 'Administración - Usuarios')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6 text-purple-700">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
        </svg>
        <h2 class="text-lg font-bold">Lista de Usuarios</h2>
        <x-button-navigation-go class="ml-auto" href="{{ route('admin.users.create') }}">Nuevo</x-button-navigation-go>
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
        @livewire('admin.user-table')
        <x-modal-global id="delete-record" title="Eliminar registro" method="DELETE"
            message="¿Seguro que deseas eliminar este registro?" buttonText="Eliminar"
            buttonColor="bg-red-600 hover:bg-red-700" :route="route('admin.users.destroy', '__ID__')" />

    </div>


</x-app-layout>
