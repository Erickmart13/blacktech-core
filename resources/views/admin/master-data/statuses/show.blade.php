<x-app-layout>
    @section('page-title', 'Contabilidad - Egresos')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="CurrentColor"
            class="text-green-700 w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v7.5m2.25-6.466a9.016 9.016 0 0 0-3.461-.203c-.536.072-.974.478-1.021 1.017a4.559 4.559 0 0 0-.018.402c0 .464.336.844.775.994l2.95 1.012c.44.15.775.53.775.994 0 .136-.006.27-.018.402-.047.539-.485.945-1.021 1.017a9.077 9.077 0 0 1-3.461-.203M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
        </svg>
        <h2 class="text-lg font-bold">Ver Egreso</h2>
        <x-button-navigation-return class="ml-auto"
            href="{{ route('admin.master-data.statuses.index') }}">Regresar</x-button-navigation-return>
    </div>

    <div class="border-2 p-2 lg:mx-5 shadow-xl">
        <div class=" overflow-x-auto shadow-md">

            <div class="flex items-center gap-4 mt-2 px-2 py-2 bg-slate-200 rounded-md">
                <span class="uppercase text-sm opacity-50">Información del Estado</span>
            </div>
            <div class="grid gap-2 md:grid-cols-1">
                {{-- Estado --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Estado:</span>
                    <span
                        class="md:w-0/3 p-1 rounded-md 
                        {{ $status->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">

                        {{ $status->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
                {{-- Nombre --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Nombre:</span>
                    <span class="md:w-2/3">{{ $status->name ?? '' }}</span>
                </div>
                {{-- Código --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Código:</span>
                    <span class="md:w-2/3">{{ $status->code ?? '' }}</span>
                </div>

                <div class="flex items-center gap-4 mt-2 px-2 py-2 bg-slate-200 rounded-md">
                    <span class="uppercase text-sm opacity-50">Información del Registro</span>
                </div>
                {{-- Creado por --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Creado por:</span>
                    <span class="md:w-2/3">{{ $status->creator->name ?? 'N/A' }}</span>
                </div>
                {{-- Fecha de creación --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Fecha de creación:</span>
                    <span class="md:w-2/3">{{ $status->created_at ?? 'N/A' }}</span>
                </div>
                {{--  Actualizado por --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Actualizado por:</span>
                    <span class="md:w-2/3"> {{ $status->editor->name ?? 'N/A' }}</span>
                </div>
                {{--  Fecha de actualización --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Fecha de actualización:</span>
                    <span class="md:w-2/3">{{ $status->updated_at ?? 'N/A' }}</span>
                </div>
                <div class="mb-3 px-5 md:px-5 mt-2 md:mt-5">
                    <x-button-navigation-go
                        class="text-ellipsis bg-lime-600 hover:bg-lime-700 focus:bg-lime-800 active:bg-lime-700  focus:ring-lime-500"
                        href="{{ route('admin.master-data.statuses.edit', $status->id) }}">Editar</x-button-navigation-go>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
