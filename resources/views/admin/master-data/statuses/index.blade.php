<x-app-layout>
    @section('page-title', 'Administración - Datos Maestros')

    <div class="flex justify-between p-4 mr-4 pl-6 px-3 gap-2 ">
        <div class="flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
            </svg>

            <h2 class="text-lg font-bold">Tipo de Estados</h2>
        </div>
        <div>
            <x-button-navigation-return class="mr-1" href="{{ route('admin.master-data.index') }}">Regresar</x-button-navigation-go>
            <x-button-navigation-go class="ml-auto" href="{{ route('admin.master-data.statuses.create') }}">Nuevo</x-button>
        </div>
    </div>
    <div class="border-2 p-2 lg:mx-5 shadow-xl">

        @if (session()->has('success'))
            <x-alert type="success" :message="session('success')" />
        @endif
        @if (session()->has('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        @livewire('admin.masterdata.statuses-table')

        <x-modal-global id="delete-record" title="Eliminar registro" method="DELETE"
            message="¿Seguro que deseas eliminar este registro?" buttonText="Eliminar"
            buttonColor="bg-red-600 hover:bg-red-700" :route="route('admin.master-data.statuses.destroy', '__ID__')" />
    </div>

</x-app-layout>
