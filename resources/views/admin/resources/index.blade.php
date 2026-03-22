<x-app-layout>
    @section('page-title', 'Administración - Recursos')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6 text-violet-500">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
        </svg>
        <h2 class="text-lg font-bold">Lista de Recursos</h2>
        <x-button-navigation-go class="ml-auto" href="{{ route('admin.resources.create') }}">Nuevo</x-button>
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
        @livewire('admin.resource-table')
        <x-modal-global id="delete-record" title="Eliminar registro" method="DELETE"
            message="¿Seguro que deseas eliminar este registro?" buttonText="Eliminar"
            buttonColor="bg-red-600 hover:bg-red-700" :route="route('admin.resources.destroy', '__ID__')" />
    </div>
</x-app-layout>
