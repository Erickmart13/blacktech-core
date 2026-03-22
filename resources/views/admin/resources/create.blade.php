<x-app-layout>
    @section('page-title', 'Administración - Recursos')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6 text-violet-500">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
        </svg>
        <h2 class="text-lg font-bold">Crear Nuevo Recurso</h2>
        <x-button-navigation-return class="ml-auto" href="{{ route('admin.resources.index') }}">Regresar</x-button>
    </div>

    <div class="border-2 p-5 md:p-2 lg:mx-5 shadow-xl">
        <form method="POST" action="{{ route('admin.resources.store') }}" class="flex flex-col min-w-0">
            @csrf
            <div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <x-alert-validate-error type="validate-error" :message="$error" />
                    @endforeach
                @endif
            </div>
            <div class="flex flex-wrap">
                <p class="leading-normal md:px-3 uppercase w-11/12 text-sm opacity-50">Información del Recurso</p>
                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre</label>
                    <input id="name" name="name" value="{{ old('name') }}" type="text"
                        placeholder="Ingrese el nombre " class="border rounded p-2 w-full">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- 🔹 Padre -->
                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-8/12 md:flex-0 md:mt-5">
                    @livewire('admin.resource-select', [
                        'selectedModule' => old('module_id'),
                        'selectedParent' => old('parent_id'),
                    ])
                </div>

                <!-- 🔹 Code -->
                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Code (opcional)</label>
                    <input type="text" name="code" class="border rounded p-2 w-full">
                </div>

                <!-- 🔹 Route -->
                <div class="mb-3 w-full max-w-full md:px-3 shrink-0 md:w-4/12 md:flex-0 md:mt-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Route</label>
                    <input type="text" name="route" class="border rounded p-2 w-full">
                </div>

                <div class="mb-3 w-full max-w-full md:px-3 shrink-0  md:w-4/12 md:flex-0 ">
                </div>

                <div class="mb-3 md:px-3 md:mt-5">
                    <x-button class="text-ellipsis">Guardar</x-button-save>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
