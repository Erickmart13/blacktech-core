<x-app-layout>
    @section('page-title', 'Administración - Módulos')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6  text-violet-500">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z" />
        </svg>
        <h2 class="text-lg font-bold">Editar Módulo</h2>
        <x-button-navigation-return class="ml-auto"
            href="{{ route('admin.modules.index') }}">Regresar</x-button-navigation-return>
    </div>

    <div class="border-2 p-5 md:p-2 lg:mx-5 shadow-xl">
        <form method="POST" action="{{ route('admin.modules.update', $module->id) }}" class="flex flex-col min-w-0">
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
                <p class="leading-normal md:px-3 uppercase w-11/12 text-sm opacity-50">Información del Módulo</p>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre</label>
                    <input id="name" name="name" value="{{ old('name', $module) }}" type="text"
                        placeholder="Ingrese el nombre " class="border rounded p-2 w-full ">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="code">Código</label>
                    <input id="code" name="code" value="{{ old('code', $module) }}" type="text"
                        placeholder="Ingrese el nombre " class="border rounded p-2 w-full ">
                    @error('code')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-2/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="order">Orden</label>
                    <input id="order" name="order" value="{{ old('order', $module) }}" type="number"
                        placeholder="Ingrese el nombre " class="border rounded p-2 w-full ">
                    @error('order')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-2/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="is_active">Estado</label>
                    <select id="is_active" name="is_active" class="border rounded p-2 w-full">
                        <option value="1" {{ old('is_active', $module->is_active) == 1 ? 'selected' : '' }}>
                            Activo</option>
                        <option value="0" {{ old('is_active', $module->is_active) == 0 ? 'selected' : '' }}>
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
