<x-app-layout>
    @section('page-title', 'Administración - Usuarios')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6 text-purple-700">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
        </svg>
        <h2 class="text-lg font-bold">Crear Nuevo Usuario</h2>
        <x-button-navigation-return class="ml-auto"
            href="{{ route('admin.users.index') }}">Regresar</x-button-navigation-return>
    </div>

    <div class="border-2 p-5 md:p-2 lg:mx-5 shadow-xl">
        <form method="POST" action="{{ route('admin.users.store') }}" class="flex flex-col min-w-0">
            @csrf
            <div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <x-alert-validate-error type="validate-error" :message="$error" />
                    @endforeach
                @endif
            </div>
            <div class="flex items-center mt-2 md:px-3 py-2 bg-slate-200 rounded">
                <span class="uppercase text-sm opacity-50">Información del Rol</span>
            </div>
            <div class="flex flex-wrap">
                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre</label>
                    <input id="name" name="name" value="{{ old('name') }}" type="text"
                        placeholder="Ingrese el nombre " class="border rounded p-2 w-full ">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Correo</label>
                    <input id="email" name="email" value="{{ old('email') }}" type="email"
                        placeholder="Ingrese el correo" class="border rounded p-2 w-full ">
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0 ">
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Contraseña</label>
                    <input id="password" name="password" value="{{ old('password') }}" type="password"
                        placeholder="Ingrese una contraseña" class="border rounded p-2 w-full ">
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Confirmar
                        contraseña</label>
                    <input id="password_confirmation" name="password_confirmation"
                        value="{{ old('password_confirmation') }}" type="password"
                        placeholder="Ingrese nuevamente la contraseña" class="border rounded p-2 w-full ">
                    @error('password_confirmation')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="rol_id">Rol</label>
                    <select name="role_id" class="border rounded p-2 w-full  text-gray-500">
                        <option value="">Seleccione un rol</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}"
                                {{ old('role_id', $rol->role_id) == $rol->id ? 'selected' : '' }}>
                                {{ $rol->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 md:px-3 md:mt-5">
                    <x-button class="text-ellipsis">Guardar</x-button>
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
