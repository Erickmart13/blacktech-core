<x-app-layout>
    @section('page-title', 'Administración - Módulos')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6 text-violet-500">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
        </svg>
        <h2 class="text-lg font-bold">Ver Recurso</h2>
        <x-button-navigation-return class="ml-auto"
            href="{{ route('admin.resources.index') }}">Regresar</x-button-navigation-return>
    </div>

    <div class="border-2 p-2 lg:mx-5 shadow-xl">
        <div class=" overflow-x-auto shadow-md">

            <div class="flex items-center gap-4 mt-2 px-2 py-2 bg-slate-200 rounded-md">
                <span class="uppercase text-sm opacity-50">Información del Recurso</span>
            </div>
            <div class="grid gap-2 md:grid-cols-1">
                {{-- Estado --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Estado:</span>
                    <span
                        class="md:w-0/3 p-1 rounded-md 
                        {{ $resource->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">

                        {{ $resource->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
                {{-- Nombre --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Nombre:</span>
                    <span class="md:w-2/3">{{ $resource->name ?? '' }}</span>
                </div>
                {{-- Padre --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Padre:</span>
                    <span class="md:w-2/3">{{ $resource->parent->name ?? '' }}</span>
                </div>
                {{-- Módulo --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Módulo:</span>
                    <span class="md:w-2/3">{{ $resource->module->name ?? '' }}</span>
                </div>
                {{-- Código --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Código:</span>
                    <span class="md:w-2/3">{{ $resource->code ?? '' }}</span>
                </div>
                {{-- Orden --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Orden</span>
                    <span class="md:w-2/3">{{ $resource->order ?? '' }}</span>
                </div>
                {{-- Ruta --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Ruta</span>
                    <span class="md:w-2/3">{{ $resource->route ?? '' }}</span>
                </div>
                {{-- Icon --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Icono</span>
                    <span class="md:w-2/3">{{ $resource->icon ?? '' }}</span>
                </div>

                <div class="flex items-center gap-4 mt-2 px-2 py-2 bg-slate-200 rounded-md">
                    <span class="uppercase text-sm opacity-50">Información del Registro</span>
                </div>
                {{-- Creado por --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Creado por:</span>
                    <span class="md:w-2/3">{{ $resource->creator->name ?? 'N/A' }}</span>
                </div>
                {{-- Fecha de creación --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Fecha de creación:</span>
                    <span class="md:w-2/3">{{ $resource->created_at ?? 'N/A' }}</span>
                </div>
                {{--  Actualizado por --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Actualizado por:</span>
                    <span class="md:w-2/3"> {{ $resource->editor->name ?? 'N/A' }}</span>
                </div>
                {{--  Fecha de actualización --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Fecha de actualización:</span>
                    <span class="md:w-2/3">{{ $resource->updated_at ?? 'N/A' }}</span>
                </div>
                <div class="mb-3 px-5 md:px-5 mt-2 md:mt-5">
                    <x-button-navigation-go
                        class="text-ellipsis bg-lime-600 hover:bg-lime-700 focus:bg-lime-800 active:bg-lime-700  focus:ring-lime-500"
                        href="{{ route('admin.resources.edit', $resource->id) }}">Editar</x-button-navigation-go>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
