<x-app-layout>
    @section('page-title', 'Administración - Usuarios')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6 text-purple-700">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
        </svg>
        <h2 class="text-lg font-bold">Editar Usuarios</h2>
        <x-button-navigation-return class="ml-auto"
            href="{{ route('admin.users.index') }}">Regresar</x-button-naviagtion-return>
    </div>

    <div class="border-2 p-5 md:p-2 lg:mx-5 shadow-xl">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
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
                <p class="leading-normal md:px-3 uppercase w-11/12 text-sm opacity-50">Información Usuario</p>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre</label>
                    <input id="name" name="name" type="text" wire:model="name"
                        value="{{ old('name', $user) }}" placeholder="Ingrese el nombre "
                        class="border rounded p-2 w-full ">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Correo</label>
                    <input id="email" name="email" value="{{ old('email', $user) }}" type="email"
                        wire:model="email" placeholder="Ingrese el correo" class="border rounded p-2 w-full ">
                    @error('cliente_dk')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-3/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="is_active">Estado</label>
                    <select id="is_active" name="is_active" class="border rounded p-2 w-full">
                        <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>
                            Activo</option>
                        <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>
                            Inactivo</option>
                    </select>
                    @error('is_active')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Contraseña</label>
                    <input id="password" name="password" type="password" 
                        autocomplete="new-password" placeholder="Ingrese contraseña solo si desea cambiarla"
                        class="border rounded p-2 w-full placeholder:text-red-500">
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Confirmar
                        contraseña</label>
                    <input id="password_confirmation" name="password_confirmation"
                        value="{{ old('password_confirmation') }}" type="password"
                        placeholder="Ingrese nuevamente la contraseña"
                        class="border rounded p-2 w-full placeholder:text-red-500">
                    @error('password_confirmation')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-3/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="rol_id">Rol</label>
                    <select name="role_id" class="border rounded p-2 w-full">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ $user->roles->first()?->id == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <input type="hidden" name="updated_at" value="{{ $user->updated_at }}">
                <div class="mb-3 md:px-3 md:mt-5">
                    <x-button class="text-ellipsis">Actualizar</x-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
