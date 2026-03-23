<div x-show="sidebarOpen && window.innerWidth < 1024" class="fixed inset-0 bg-black bg-opacity-40 z-30 lg:hidden"
    @click="sidebarOpen = false"></div>
<aside x-cloak
    class="mt-28 mb-5 fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-xl rounded-2xl overflow-y-auto transform transition-transform duration-300 ease-in-out lg:ml-4"
    :class="{ '-translate-x-full': !sidebarOpen && window.innerWidth < 1024, 'translate-x-5 lg:translate-x-0': sidebarOpen }">
    <header class="bg-red-800 text-white text-center py-4 sticky top-0 z-50">
        <!-- Logo y título -->
        <h1 class="text-2xl font-medium text-white text-center py-4">
            BlackTech-Core
        </h1>
    </header>
    <!-- Lista de CRM -->
    <ul class="">
        {{-- Dashboard --}}
        @can('dashboard_dashboard.index')
            <li class="pt-2 pl-2">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center w-full gap-3 px-2 py-2 text-base font-semibold text-gray-900 hover:bg-gray-300 rounded-s-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-blue-700">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
        @endcan

        <!-- Seccione ERP -->
        <div class="flex justify-start pl-5 mt-2 opacity-40 ">
            <label>ERP</label>
        </div>
        <div class="border-t border-gray-200 my-2"></div>
        {{-- Gestión Operaciones --}}
        @canany(['operaciones.inicio', 'proveedores'])
            <li class="pt-2 pl-2" x-data="{ open: {{ request()->routeIs('customs-processes.*') || request()->routeIs('beneficiaries.*') || request()->routeIs('suppliers.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full gap-3 px-2 py-2 text-base font-semibold text-gray-900 hover:bg-gray-300 rounded-s-lg">
                    <div class="flex items-center gap-3">
                        <!-- SVG de Carpeta / Comercial -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-orange-800">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5h18M3 12h18M3 16.5h18" />
                        </svg>
                        <span>Operaciones</span>
                    </div>
                    <svg :class="{ 'rotate-90': open }" class="w-5 h-5 mr-2 transition-transform"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>

                </button>
                <ul x-show="open" x-transition class=" ">
                    {{-- Operaciones --}}
                    @can('operaciones.inicio')
                        <li class="mt-1 w-full pr-2 pl-2">
                            {{-- <a href="{{ route('customs-processes.index') }}" --}}
                            <a href="#"
                                class="flex items-center gap-1 p-2 text-base font-semibold text-gray-900 hover:bg-gray-300 hover:bg-opacity-60 focus:bg-blue-100 transition-colors rounded-lg mx-8 {{ request()->routeIs('customs-processes.*') ? 'bg-gray-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6 text-orange-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                </svg>
                                <span class="font-light">Procesos</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        <div class="flex justify-start pl-5 mt-4 opacity-40">
            <label>Administración</label>
        </div>
        <div class="border-t border-gray-200 my-2"></div>
        {{-- Administración --}}
        @canany(['administracion_usuarios.index', 'administracion_roles.index', 'sistema.inicio', 'modulos.ver'])
            <li class="pt-2 pl-2 mb-2" x-data="{ open: {{ request()->routeIs('users.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.modules.*') || request()->routeIs('admin.permissions.*') || request()->routeIs('admin.resources.*') || request()->routeIs('roles.*') || request()->routeIs('admin.master-data.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full gap-3 px-2 py-2 text-base font-semibold text-gray-900 hover:bg-gray-300 rounded-s-lg">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-indigo-800">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5h18M3 12h18M3 16.5h18" />
                        </svg>
                        <span>Administración</span>
                    </div>
                    <svg :class="{ 'rotate-90': open }" class="w-5 h-5 mr-2 transition-transform"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <ul x-show="open" x-transition class=" ">
                    {{-- Usuarios --}}
                    @can('administracion_usuarios.index')
                        <li class="mt-1 w-full pr-2 pl-2">
                            {{-- <a href="{{ route('users.index') }}" --}}
                            <a href="#"
                                class="flex items-center gap-1 p-2 text-base font-semibold text-gray-900 hover:bg-gray-300 hover:bg-opacity-60 focus:bg-blue-100 transition-colors rounded-lg mx-8 {{ request()->routeIs('users.*') ? 'bg-gray-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6 text-indigo-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                                <span class="font-light">Usuarios</span>
                            </a>
                        </li>
                    @endcan
                    {{-- Roles --}}
                    @can('administracion_roles.index')
                        <li class="mt-1 w-full pr-2 pl-2">
                            <a href="{{ route('admin.roles.index') }}"
                                class="flex items-center gap-1 p-2 text-base font-semibold text-gray-900 hover:bg-gray-300 hover:bg-opacity-60 focus:bg-blue-100 transition-colors rounded-lg mx-8 {{ request()->routeIs('admin.roles.*') ? 'bg-gray-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-fuchsia-500" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M9 10a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                </svg>
                                <span class="font-light">Roles</span>
                            </a>
                        </li>
                    @endcan
                    {{-- Permisos --}}
                    @can('administracion_permisos.index')
                        <li class="mt-1 w-full pr-2 pl-2">
                            <a href="{{ route('admin.permissions.index') }}"
                                class="flex items-center gap-1 p-2 text-base font-semibold text-gray-900 hover:bg-gray-300 hover:bg-opacity-60 focus:bg-blue-100 transition-colors rounded-lg mx-8 {{ request()->routeIs('admin.permissions.*') ? 'bg-gray-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-purple-500" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-check">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                    <path d="M15 19l2 2l4 -4" />
                                </svg>
                                <span class="font-light">Permisos</span>
                            </a>
                        </li>
                    @endcan
                    {{-- Módulos --}}
                    @can('administracion_modulos.index')
                        <li class="mt-1 w-full pr-2 pl-2">
                            <a href="{{ route('admin.modules.index') }}"
                                class="flex items-center gap-1 p-2 text-base font-semibold text-gray-900 hover:bg-gray-300 hover:bg-opacity-60 focus:bg-blue-100 transition-colors rounded-lg mx-8 {{ request()->routeIs('admin.modules.*') ? 'bg-gray-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6  text-indigo-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z" />
                                </svg>

                                <span class="font-light">Módulos</span>
                            </a>
                        </li>
                    @endcan
                    {{-- Recursos --}}
                    @can('administracion_recursos.index')
                        <li class="mt-1 w-full pr-2 pl-2">
                            <a href="{{ route('admin.resources.index') }}"
                                class="flex items-center gap-1 p-2 text-base font-semibold text-gray-900 hover:bg-gray-300 hover:bg-opacity-60 focus:bg-blue-100 transition-colors rounded-lg mx-8 {{ request()->routeIs('admin.resources.*') ? 'bg-gray-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 text-violet-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                                <span class="font-light">Recursos</span>
                            </a>
                        </li>
                    @endcan
                    @can('sistema_datos_maestros.index')
                        {{-- sistema --}}
                        <li class="mt-1 w-full pr-2 pl-2 pb-2">
                            <a href="{{ route('admin.master-data.index') }}"
                                class="flex items-center gap-1 p-2 text-base font-semibold text-gray-900 hover:bg-gray-300 hover:bg-opacity-60 focus:bg-blue-100 transition-colors rounded-lg mx-8 {{ request()->routeIs('admin.master-data.*') ? 'bg-gray-300' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 text-slate-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                </svg>

                                <span class="font-light">Datos Maestros</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany
        <!-- Botón Cerrar Sesión (solo en móviles) -->
        <div class="pl-2 pb-4 lg:hidden">
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button type="submit"
                    class="flex items-center w-full gap-3 px-2 py-2 text-base font-semibold text-red-600 hover:bg-gray-300 rounded-s-lg">
                    <!-- Icono -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M18 12H9m9 0-3 3m3-3-3-3" />
                    </svg>
                    <span>Cerrar sesión</span>
                </button>
            </form>
        </div>
    </ul>
</aside>
