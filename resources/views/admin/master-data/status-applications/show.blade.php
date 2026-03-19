<x-app-layout>
    @section('page-title', 'Contabilidad - Egresos')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-status-change">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M4 18a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
            <path d="M16 18a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
            <path d="M6 12v-2a6 6 0 1 1 12 0v2" />
            <path d="M15 9l3 3l3 -3" />
        </svg>
        <h2 class="text-lg font-bold">Ver Aplicación de estado</h2>
        <x-button-navigation-return class="ml-auto"
            href="{{ route('admin.master-data.status-applications.index') }}">Regresar</x-button-navigation-return>
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
                        {{ $statusApplication->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">

                        {{ $statusApplication->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
                {{-- Nombre --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Entidad:</span>
                    <span class="md:w-2/3">{{ $statusApplication->applies_to ?? '' }}</span>
                </div>
                {{-- Código --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Estado - Entidad:</span>
                    <span class="md:w-2/3">{{ $statusApplication->status->name ?? '' }}</span>
                </div>

                <div class="flex items-center gap-4 mt-2 px-2 py-2 bg-slate-200 rounded-md">
                    <span class="uppercase text-sm opacity-50">Información del Registro</span>
                </div>
                {{-- Creado por --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Creado por:</span>
                    <span class="md:w-2/3">{{ $statusApplication->creator->name ?? 'N/A' }}</span>
                </div>
                {{-- Fecha de creación --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Fecha de creación:</span>
                    <span class="md:w-2/3">{{ $statusApplication->created_at ?? 'N/A' }}</span>
                </div>
                {{--  Actualizado por --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Actualizado por:</span>
                    <span class="md:w-2/3"> {{ $statusApplication->editor->name ?? 'N/A' }}</span>
                </div>
                {{--  Fecha de actualización --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Fecha de actualización:</span>
                    <span class="md:w-2/3">{{ $statusApplication->updated_at ?? 'N/A' }}</span>
                </div>
                <div class="mb-3 px-5 md:px-5 mt-2 md:mt-5">
                    <x-button-navigation-go
                        class="text-ellipsis bg-lime-600 hover:bg-lime-700 focus:bg-lime-800 active:bg-lime-700  focus:ring-lime-500"
                        href="{{ route('admin.master-data.status-applications.edit', $statusApplication->id) }}">Editar</x-navigation-go>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
