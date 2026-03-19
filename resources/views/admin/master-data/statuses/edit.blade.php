<x-app-layout>
    @section('page-title', 'Administración - Sistema')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
        </svg>
        <h2 class="text-lg font-bold">Editar tipo de estado</h2>
        <x-button-navigation-return class="ml-auto" href="{{ route('admin.master-data.statuses.index') }}">Regresar</x-button>
    </div>

    <div class="border-2 p-2 lg:mx-5 shadow-xl">
        <div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <x-alert-validate-error type="validate-error" :message="$error" />
                @endforeach
            @endif
        </div>

        <form method="POST" action="{{ route('admin.master-data.statuses.update', $status->id) }}"
            class="flex flex-col min-w-0">
            @csrf
            @method('PUT')

            <div class="flex flex-wrap ">
                <p class="leading-normal md:px-3 uppercase w-11/12 text-sm opacity-50">Información Sistema</p>

                <div class="w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre</label>
                    <select id="name" name="name" class="border rounded p-2 w-full">
                        <optgroup label="General">
                           
                            <option value="Pendiente"
                                {{ old('name', $status->name) === 'Pendiente' ? 'selected' : '' }}>Pendiente
                            </option>
                            <option value="En proceso"
                                {{ old('name', $status->name) === 'En proceso' ? 'selected' : '' }}>En proceso
                            </option>
                            <option value="Completado"
                                {{ old('name', $status->name) === 'Completado' ? 'selected' : '' }}>Completado
                            </option>
                            <option value="Cancelado"
                                {{ old('name', $status->name) === 'Cancelado' ? 'selected' : '' }}>Cancelado
                            </option>
                        </optgroup>

                        <optgroup label="Clientes">
                            <option value="Nuevo" {{ old('name', $status->name) === 'Nuevo' ? 'selected' : '' }}>Nuevo
                            </option>
                            <option value="Prospecto"
                                {{ old('name', $status->name) === 'Prospecto' ? 'selected' : '' }}>Prospecto
                            </option>
                            <option value="Suspendido"
                                {{ old('name', $status->name) === 'Suspendido' ? 'selected' : '' }}>Suspendido
                            </option>
                            <option value="Moroso" {{ old('name', $status->name) === 'Moroso' ? 'selected' : '' }}>
                                Moroso</option>
                        </optgroup>

                        <optgroup label="Usuarios">
                            <option value="Registrado"
                                {{ old('name', $status->name) === 'Registrado' ? 'selected' : '' }}>Registrado
                            </option>
                            <option value="Verificado"
                                {{ old('name', $status->name) === 'Verificado' ? 'selected' : '' }}>Verificado
                            </option>
                            <option value="Bloqueado"
                                {{ old('name', $status->name) === 'Bloqueado' ? 'selected' : '' }}>Bloqueado
                            </option>
                            <option value="Eliminado"
                                {{ old('name', $status->name) === 'Eliminado' ? 'selected' : '' }}>Eliminado
                            </option>
                        </optgroup>

                        <optgroup label="Tareas / Procesos">
                            <option value="Abierto" {{ old('name', $status->name) === 'Abierto' ? 'selected' : '' }}>
                                Abierto
                            </option>
                            <option value="Cerrado" {{ old('name', $status->name) === 'Cerrado' ? 'selected' : '' }}>
                                Cerrado
                            </option>
                            <option value="Asignado" {{ old('name', $status->name) === 'Asignado' ? 'selected' : '' }}>
                                Asignado
                            </option>
                            <option value="Solicitado"
                                {{ old('name', $status->name) === 'Solicitado' ? 'selected' : '' }}>
                                Solicitado
                            </option>
                            <option value="Reabierto"
                                {{ old('name', $status->name) === 'Reabierto' ? 'selected' : '' }}>Reabierto
                            </option>
                            <option value="Revisado" {{ old('name', $status->name) === 'Revisado' ? 'selected' : '' }}>
                                Revisado
                            </option>
                            <option value="Rechazado"
                                {{ old('name', $status->name) === 'Rechazado' ? 'selected' : '' }}>Rechazado
                            </option>
                            <option value="Aprobado" {{ old('name', $status->name) === 'Aprobado' ? 'selected' : '' }}>
                                Aprobado
                            </option>
                            <option value="Finalizado" {{ old('name', $status->name) === 'Finalizado' ? 'selected' : '' }}>
                                Finalizado
                            </option>
                            <option value="Pagado" {{ old('name', $status->name) === 'Pagado' ? 'selected' : '' }}>
                                Pagado
                            </option>
                        </optgroup>
                    </select>
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="code">Código</label>
                    <input id="code" name="code" value="{{ old('code', $status) }}" type="text"
                        placeholder="Ingrese el nombre " class="border rounded p-2 w-full ">
                    @error('code')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-4/12 md:flex-0">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="is_active">Estado</label>
                    <select id="is_active" name="is_active" class="border rounded p-2 w-full">
                        <option value="1" {{ old('is_active', $status->is_active) == 1 ? 'selected' : '' }}>
                            Activo</option>
                        <option value="0" {{ old('is_active', $status->is_active) == 0 ? 'selected' : '' }}>
                            Inactivo</option>
                    </select>
                    @error('is_active')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 md:px-3 md:mt-5">
                    <x-button class="text-ellipsis">Actualizar</x-button-save>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
