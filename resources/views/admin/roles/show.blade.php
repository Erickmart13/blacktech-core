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
        <h2 class="text-lg font-bold">Ver Rol</h2>
        <x-button-navigation-return class="ml-auto"
            href="{{ route('admin.roles.index') }}">Regresar</x-button-navigation-return>
    </div>

    <div class="border-2 p-2 lg:mx-5 shadow-xl">
        <div class=" overflow-x-auto shadow-md">
            <div class="grid gap-2 md:grid-cols-1">
                <div class="flex items-center gap-4 mt-2 md:px-3 py-2 bg-slate-200 rounded">
                    <span class="uppercase text-sm opacity-50">Información del Rol</span>
                </div>
                {{-- Estado --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Estado:</span>
                    <span
                        class="md:w-0/3 p-1 rounded-md 
                        {{ $roles->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">

                        {{ $roles->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
                {{-- Nombre --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Nombre:</span>
                    <span class="md:w-2/3">{{ $roles->name ?? '' }}</span>
                </div>

            </div>
            <div class="flex items-center gap-4 mt-2 md:px-3 py-2 bg-slate-200 rounded">
                <span class="uppercase text-sm opacity-50">Información de los Permisos</span>
            </div>
            @if ($permissions->isNotEmpty())
                @foreach ($permissions as $module => $resources)
                    <div class="border rounded-lg p-4 mb-2 bg-white shadow">
                        {{-- 🔷 MÓDULO --}}
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-lg font-bold ">
                                {{ ucfirst($module) }}
                            </h2>
                        </div>

                        {{-- 🔹 RESOURCES --}}
                        @foreach ($resources as $resource => $perms)
                            <div class="mb-4 pl-4 border-l-4 border-indigo-200">
                                {{-- Nombre limpio --}}
                                @php
                                    $resourceName = Str::of($resource)
                                        ->after($module . '_')
                                        ->replace('_', ' ')
                                        ->title();
                                @endphp

                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="font-semibold text-gray-700">
                                        {{ $resourceName }}
                                    </h3>
                                </div>

                                {{-- Permisos --}}
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                    @foreach ($perms as $permission)
                                        @php
                                            $action = explode('.', $permission->name)[1];
                                            $checked = $roles->hasPermissionTo($permission->name); // ✅ verifica si el rol tiene el permiso
                                        @endphp

                                        <label class="flex items-center gap-2 text-sm">
                                            <input type="checkbox" class="rounded" value="{{ $permission->name }}"
                                                disabled {{-- solo lectura --}}
                                                @if ($checked) checked @endif>
                                            {{ ucfirst($action) }}
                                        </label>
                                    @endforeach
                                </div>

                            </div>
                        @endforeach

                    </div>
                @endforeach
            @else
                <div class="flex justify-between items-center">
                    <span class="font-medium text-gray-600 text-sm">Permisos:</span>
                    <span class="text-gray-400 text-sm">Sin permisos asignados</span>
                </div>
            @endif
            <div class="grid gap-2 md:grid-cols-1">
                <div class="flex items-center gap-4 mt-2 md:px-3 py-2 bg-slate-200 rounded">
                    <span class="uppercase text-sm opacity-50">Información del Registro</span>
                </div>
                {{-- Creado por --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Creado por:</span>
                    <span class="md:w-2/3">{{ $roles->creator->name ?? 'N/A' }}</span>
                </div>
                {{-- Fecha de creación --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Fecha de creación:</span>
                    <span class="md:w-2/3">{{ $roles->created_at ?? 'N/A' }}</span>
                </div>
                {{--  Actualizado por --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Actualizado por:</span>
                    <span class="md:w-2/3"> {{ $roles->editor->name ?? 'N/A' }}</span>
                </div>
                {{--  Fecha de actualización --}}
                <div class="flex md:flex-row flex-col border-b border-gray-200 px-6 py-4">
                    <span class="font-bold md:w-1/3">Fecha de actualización:</span>
                    <span class="md:w-2/3">{{ $roles->updated_at ?? 'N/A' }}</span>
                </div>

            </div>
            <div class="mb-3 px-5 md:px-5 mt-2 md:mt-5">
                <x-button-navigation-go
                    class="text-ellipsis bg-lime-600 hover:bg-lime-700 focus:bg-lime-800 active:bg-lime-700  focus:ring-lime-500"
                    href="{{ route('admin.master-data.statuses.edit', $roles->id) }}">Editar</x-button-navigation-go>
            </div>
        </div>
    </div>
</x-app-layout>
