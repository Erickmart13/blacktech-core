<x-app-layout>
    @section('page-title', 'Administración - Datos Maestros')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6 text-slate-500">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
        </svg>
        <h2 class="text-lg font-bold">Panel de Datos Maestros</h2>
    </div>

    <div class="border-2 p-2 lg:mx-5 shadow-xl">
        @if (session()->has('success'))
            <x-alert type="success" :message="session('success')" />
        @endif
        @if (session()->has('error'))
            <x-alert type="error" :message="session('error')" />
        @endif
        <div class="p-0 overflow-x-auto">
            <div class="container p-2">
                @canany(['sistema_estados.index'])
                    <!--Titulo General -->
                    <div class="flex items-center gap-4">
                        <div class="flex-1 border-t border-gray-300"></div>
                        <span class="uppercase text-sm opacity-50">General</span>
                        <div class="flex-1 border-t border-gray-300"></div>
                    </div>
                @endcanany
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ">


                    @can('sistema_estados.index')
                        <a href="{{ route('admin.master-data.statuses.index') }}"
                            class="p-4 bg-white border-2 rounded-xl shadow hover:bg-gray-300 transition">
                            <h2 class="font-semibold">Tipos de estados</h2>
                            <p class="text-sm text-gray-600">Gestión de tipos estados.
                            </p>
                        </a>
                    @endcan

                    @can('sistema_asignar_estados.index')
                        <a href="{{ route('admin.master-data.status-applications.index') }}"
                            class="p-4 bg-white border-2 rounded-xl shadow hover:bg-gray-300 transition">
                            <h2 class="font-semibold">Asignación de estados</h2>
                            <p class="text-sm text-gray-600">Gestión de asignación estados.
                            </p>
                        </a>
                    @endcan







                </div>
            </div>
        </div>

</x-app-layout>
