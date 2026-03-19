<x-app-layout>
    @section('page-title', 'Administración - Sistema')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
        </svg>
        <h2 class="text-lg font-bold">Crear nuevo tipo de estado</h2>
        <x-button-navigation-return class="ml-auto"
            href="{{ route('admin.master-data.statuses.index') }}">Regresar</x-button>
    </div>

    <div class="border-2 p-2 lg:mx-5 shadow-xl">
        <div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <x-alert-validate-error type="validate-error" :message="$error" />
                @endforeach
            @endif
        </div>

        <form method="POST" action="{{ route('admin.master-data.statuses.store') }}" class="flex flex-col min-w-0">
            @csrf
            <div class="flex flex-wrap">
                <p class="leading-normal md:px-3 uppercase w-11/12 text-sm opacity-50">Información Sistema</p>

                <div class="w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre</label>
                    <select id="name" name="name" class="border rounded p-2 w-full">
                        <optgroup label="General">
                            <option value="">Seleccione</option>
                            <option value="Pendiente" {{ old('name') == 'Pendiente' ? 'selected' : '' }}>Pendiente
                            </option>
                            <option value="En proceso" {{ old('name') == 'En proceso' ? 'selected' : '' }}>En
                                proceso</option>
                            <option value="Completado" {{ old('name') == 'Completado' ? 'selected' : '' }}>
                                Completado</option>
                            <option value="Cancelado" {{ old('name') == 'Cancelado' ? 'selected' : '' }}>Cancelado
                            </option>
                        </optgroup>

                        <optgroup label="Clientes">
                            <option value="Nuevo" {{ old('name') == 'Nuevo' ? 'selected' : '' }}>Nuevo</option>
                            <option value="Prospecto" {{ old('name') == 'Prospecto' ? 'selected' : '' }}>Prospecto
                            </option>
                            <option value="Suspendido" {{ old('name') == 'Suspendido' ? 'selected' : '' }}>
                                Suspendido</option>
                            <option value="Moroso" {{ old('name') == 'Moroso' ? 'selected' : '' }}>Moroso</option>
                        </optgroup>

                        <optgroup label="Usuarios">
                            <option value="Registrado" {{ old('name') == 'Registrado' ? 'selected' : '' }}>
                                Registrado</option>
                            <option value="Verificado" {{ old('name') == 'Verificado' ? 'selected' : '' }}>
                                Verificado</option>
                            <option value="Bloqueado" {{ old('name') == 'Bloqueado' ? 'selected' : '' }}>Bloqueado
                            </option>
                            <option value="Eliminado" {{ old('name') == 'Eliminado' ? 'selected' : '' }}>Eliminado
                            </option>
                        </optgroup>

                        <optgroup label="Tareas / Procesos">
                            <option value="Abierto" {{ old('name') == 'Abierto' ? 'selected' : '' }}>Abierto
                            </option>
                            <option value="Solicitado" {{ old('name') == 'Solicitado' ? 'selected' : '' }}>
                                Solicitado</option>
                            <option value="Cerrado" {{ old('name') == 'Cerrado' ? 'selected' : '' }}>Cerrado
                            </option>
                            <option value="Asignado" {{ old('name') == 'Asignado' ? 'selected' : '' }}>Asignado
                            </option>
                            <option value="Reabierto" {{ old('name') == 'Reabierto' ? 'selected' : '' }}>Reabierto
                            </option>
                            <option value="Revisado" {{ old('name') == 'Revisado' ? 'selected' : '' }}>Revisado
                            </option>
                            <option value="Rechazado" {{ old('name') == 'Rechazado' ? 'selected' : '' }}>Rechazado
                            </option>
                            <option value="Aprobado" {{ old('name') == 'Aprobado' ? 'selected' : '' }}>Aprobado
                            </option>
                            <option value="Pagado" {{ old('name') == 'Pagado' ? 'selected' : '' }}>Pagado
                            </option>
                        </optgroup>
                    </select>
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="w-full max-w-full md:px-3 shrink-0  md:w-8/12 md:flex-0">
                </div>

                <div class="mb-3 md:px-3 md:mt-5">
                    <x-button class="text-ellipsis">Guardar</x-button-save>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.querySelectorAll("select").forEach(select => {
                    // 👉 Al cargar la página, si ya tiene valor (old o edit), arranca en negro
                    if (select.value) {
                        select.classList.remove("text-gray-500");
                        select.classList.add("text-black");
                    } else {
                        select.classList.add("text-gray-500");
                    }
                    // 👉 Cuando cambie el valor, actualizar color
                    select.addEventListener("change", function() {
                        if (this.value) {
                            this.classList.remove("text-gray-500");
                            this.classList.add("text-black");
                        } else {
                            this.classList.remove("text-black");
                            this.classList.add("text-gray-500");
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
