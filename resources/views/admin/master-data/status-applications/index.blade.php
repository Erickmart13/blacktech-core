<x-app-layout>
    @section('page-title', 'Administración - Datos Maestros')

    <div class="flex justify-between p-4 mr-4 pl-6 px-3 gap-2 ">
        <div class="flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-status-change">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 18a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M16 18a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M6 12v-2a6 6 0 1 1 12 0v2" />
                <path d="M15 9l3 3l3 -3" />
            </svg>

            <h2 class="text-lg font-bold">Asignación de estados</h2>
        </div>
        <div>
            <x-button-navigation-return class="mr-1"
                href="{{ route('admin.master-data.index') }}">Regresar</x-button-navigation-return>
                <x-button-navigation-go class="ml-auto"
                    href="{{ route('admin.master-data.status-applications.create') }}">Asignar</x-button-navigation-go>
        </div>
    </div>
    <div class="border-2 p-2 lg:mx-5 shadow-xl">
        @if (session()->has('success'))
            <x-alert type="success" :message="session('success')" />
        @endif
        @if (session()->has('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        @livewire('admin.masterdata.status-applications-table')
        <x-modal-global id="delete-record" title="Eliminar registro" method="DELETE"
            message="¿Seguro que deseas eliminar este registro?" buttonText="Eliminar"
            buttonColor="bg-red-600 hover:bg-red-700" :route="route('admin.master-data.status-applications.destroy', '__ID__')" />
    </div>

</x-app-layout>
