<x-app-layout>
    @section('page-title', 'Administración - Datos Maestros')

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
        <h2 class="text-lg font-bold">Editar tipo de estado asignado</h2>
        <x-button-navigation-return class="ml-auto"
            href="{{ route('admin.master-data.status-applications.index') }}">Regresar</x-button-navigation-return>
    </div>

    <div class="border-2 p-2 lg:mx-5 shadow-xl">
        <div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <x-alert-validate-error type="validate-error" :message="$error" />
                @endforeach
            @endif
        </div>

        <form method="POST"
            action="{{ route('admin.master-data.status-applications.update', $statusApplication->id) }}"
            class="flex flex-col min-w-0">
            @csrf
            @method('PUT')
            <div class="flex flex-wrap ">
                <p class="leading-normal md:px-3 uppercase w-11/12 text-sm opacity-50">Información Catálogo</p>

                <div class="w-full max-w-full md:px-3 shrink-0 md:w-4/12 md:flex-0">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="applies_to">Entidad</label>
                    <select id="applies_to" name="applies_to" class="border rounded p-2 w-full">
                        <option value="">Seleccione una entidad</option>
                        @foreach ($entities as $entity)
                            <option value="{{ $entity }}"
                                {{ old('applies_to', $statusApplication->applies_to) == $entity ? 'selected' : '' }}>
                                {{ $entity }}
                            </option>
                        @endforeach
                    </select>
                    @error('applies_to')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full max-w-full md:px-3 shrink-0 md:w-3/12 md:flex-0">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status_id">Estado Entidad</label>
                    <select id="status_id" name="status_id" class="border rounded p-2 w-full">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}"
                                {{ old('status_id', $statusApplication->status_id) == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('status_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-4/12 md:flex-0">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="is_active">Estado</label>
                    <select id="is_active" name="is_active" class="border rounded p-2 w-full">
                        <option value="1"
                            {{ old('is_active', $statusApplication->is_active) == 1 ? 'selected' : '' }}>
                            Activo</option>
                        <option value="0"
                            {{ old('is_active', $statusApplication->is_active) == 0 ? 'selected' : '' }}>
                            Inactivo</option>
                    </select>
                    @error('is_active')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 md:px-3 md:mt-5">
                    <x-button class="text-ellipsis">Actualizar</x-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
