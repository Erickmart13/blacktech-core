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
        <h2 class="text-lg font-bold">Crear nuevo rol</h2>
        <x-button-navigation-return class="ml-auto"
            href="{{ route('admin.roles.index') }}">Regresar</x-button-navigation-return>
    </div>

    <div class="border-2 p-5 md:p-2 lg:mx-5 shadow-xl">
        <form method="POST" action="{{ route('admin.roles.store') }}" class=" flex flex-col min-w-0">
            @csrf
            <div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <x-alert-validate-error type="validate-error" :message="$error" />
                    @endforeach
                @endif
            </div>

            <div class="flex items-center gap-4 mt-2 md:px-3 py-2 bg-slate-200 rounded">
                <span class="uppercase text-sm opacity-50">Información del Rol</span>
            </div>
            <div class="mb-3 w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0 md:mt-5">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre</label>
                <input id="name" name="name" value="{{ old('name') }}" type="text"
                    placeholder="Ingrese nombre del rol" class="border rounded p-2 w-full ">
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center gap-4 mt-2 md:px-3 py-2 bg-slate-200 rounded">
                <span class="uppercase text-sm opacity-50">Información de los Permisos</span>
            </div>
            <div class="flex justify-end mt-2 mr-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" id="check-all-permissions" class="rounded">
                    <span class="font-semibold">Seleccionar todos los permisos</span>
                </label>
            </div>

            <div class="mb-3 w-full max-w-full md:px-3 shrink-0  md:w-12/12 md:mt-3">
                @foreach ($permissions as $module => $resources)
                    <div class="module-block mb-6 p-4 border  rounded-lg">
                        {{-- 🔷 MÓDULO --}}
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-lg font-bold ">Módulo {{ ucfirst($module) }}</h2>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="check-module rounded">
                                <span class="text-sm">Seleccionar módulo</span>
                            </label>
                        </div>

                        {{-- 🔹 RESOURCES --}}
                        @foreach ($resources as $resource => $perms)
                            <div class="resource-block mb-4 pl-4 border-l-4 border-indigo-200">
                                {{-- Nombre limpio --}}
                                @php
                                    $resourceName = Str::of($resource)
                                        ->after($module . '_')
                                        ->replace('_', ' ')
                                        ->title();
                                @endphp
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="font-semibold text-gray-700">{{ $resourceName }}</h3>
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" class="check-resource rounded">
                                        <span class="text-xs">Seleccionar recurso</span>
                                    </label>
                                </div>

                                {{-- Permisos --}}
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                    @foreach ($perms as $permission)
                                        @php $action = explode('.', $permission->name)[1]; @endphp
                                        <label class="flex items-center gap-2 text-sm">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                class="check-permission rounded">
                                            {{ ucfirst($action) }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

            </div>
            <div class="mb-3 md:px-3 ">
                <x-button class="text-ellipsis">Guardar</x-button>
            </div>

        </form>

    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // 🔹 Checkbox global
                const globalCheckbox = document.getElementById('check-all-permissions');
                globalCheckbox.addEventListener('change', function() {
                    const checked = this.checked;
                    document.querySelectorAll('.check-module, .check-resource, .check-permission')
                        .forEach(cb => cb.checked = checked);
                });

                // 🔹 Seleccionar todo módulo
                document.querySelectorAll('.check-module').forEach(moduleCheckbox => {
                    moduleCheckbox.addEventListener('change', function() {
                        const moduleBlock = this.closest('.module-block');
                        moduleBlock.querySelectorAll('.check-resource, .check-permission')
                            .forEach(cb => cb.checked = this.checked);
                    });
                });

                // 🔹 Seleccionar todo resource
                document.querySelectorAll('.check-resource').forEach(resourceCheckbox => {
                    resourceCheckbox.addEventListener('change', function() {
                        const resourceBlock = this.closest('.resource-block');
                        resourceBlock.querySelectorAll('.check-permission')
                            .forEach(cb => cb.checked = this.checked);
                    });
                });

            });
        </script>
    @endpush
</x-app-layout>
