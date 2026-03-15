<x-app-layout>
    @section('page-title', 'Administración - Roles')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6 text-purple-500">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
        </svg>
        <h2 class="text-lg font-bold">Editar rol</h2>
        <x-button-retorn class="ml-auto" href="{{ route('roles.index') }}">Regresar</x-button>
    </div>

    <div class="border-2 p-5 md:p-2 lg:mx-5 shadow-xl">
        <form method="POST" action="{{ route('roles.update', $roles->id) }}" class=" flex flex-col min-w-0">
            @csrf
            @method('PUT')
            <div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <x-alert-validate-error type="validate-error" :message="$error" />
                    @endforeach
                @endif
            </div>

            <div class="flex flex-wrap">
                <p class="leading-normal md:px-3 uppercase w-11/12 text-sm opacity-50">Información Rol</p>
                <div class="mb-3 w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre</label>
                    <input id="name" name="name" value="{{ old('name', $roles) }}" type="text"
                        placeholder="Ingrese nombre del rol" class="border rounded p-2 w-full ">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <hr class="my-3 w-full border-gray-300">
                <p class="leading-normal md:px-3 uppercase w-full text-sm opacity-50">Seleccionar Permisos</p>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-12/12 md:flex-0 md:mt-5">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach ($permissions->groupBy('type') as $group => $perms)
                            <div x-data="{ allSelected: false }">
                                <!-- Encabezado con checkbox maestro -->
                                <div class="flex items-center mb-3">
                                    <input type="checkbox" x-model="allSelected"
                                        @change="$refs.group.querySelectorAll('input[type=checkbox]').forEach(c => c.checked = allSelected)"
                                        class="rounded border-gray-300 text-indigo-500 shadow-sm focus:ring-blue-600">
                                    <h4 class=" text-gray-700 text-sm font-bold pl-2">
                                        {{ ucfirst($group) }}
                                    </h4>
                                </div>
                                <!-- Lista vertical de permisos -->
                                <div class="space-y-2 ml-6" x-ref="group">
                                    @foreach ($perms as $doc)
                                        <label class="flex items-center space-x-2">
                                            <input type="checkbox" name="permissions[]" value="{{ $doc->id }}"
                                                @checked(in_array($doc->id, old('permissions', $roles->permissions->pluck('id')->toArray())))
                                                class="rounded border-gray-300 text-indigo-500 shadow-sm focus:ring-blue-600">
                                            <span>{{ $doc->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('permissions')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 md:px-3 md:mt-5">
                    <x-button-save class="text-ellipsis">Actualizar</x-button-save>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
