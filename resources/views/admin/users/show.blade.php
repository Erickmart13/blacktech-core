<x-app-layout>
    @section('page-title', 'Administración - Usuarios')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6 text-indigo-500">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
        </svg>
        <h2 class="text-lg font-bold">Ver Usuario</h2>
        <x-button-retorn class="ml-auto" href="{{ route('users.index') }}">Regresar</x-button>
    </div>

    <div class="border-2 p-2 lg:mx-5 shadow-xl">
        <div class="hidden sm:block overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <tbody>
                    <tr class="bg-gray-100">
                        <td colspan="2" class="px-6 py-4 text-lg uppercase font-extralight opacity-90">
                            Información de Perfil
                        </td>
                    </tr>

                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 text-gray-900 text-lg font-bold mb-2">
                            Código :
                        </th>
                        <td class="px-6 py-4 text-gray-800 font-light text-lg mb-2">
                            {{ $user->code ?? 'N/A' }}</td>
                    </tr>
                    <tr class="bg-white border-b">
                        @php
                            $statusName = $user->statusApplication->status->name ?? 'N/A';

                            $statusColors = [
                                'Activo' => 'bg-green-300 ',
                                'Inactivo' => 'bg-red-300 ',
                                'N/A' => 'bg-gray-300 text-gray-900',
                            ];
                            $statusClass = $statusColors[$statusName] ?? 'bg-gray-300 text-gray-900';
                        @endphp
                        <th scope="row" class="px-6 py-4 text-gray-900 text-lg font-bold mb-2">
                            Estado :
                        </th>
                        <td class="px-6 py-4 text-gray-800 font-light text-lg mb-2 ">
                            <span class="p-2 rounded-md font-light text-lg {{ $statusClass }}">
                                {{ $statusName }}
                            </span>
                        </td>
                    </tr>
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 text-gray-900 text-lg font-bold mb-2">
                            Nombre :
                        </th>
                        <td class="px-6 py-4 text-gray-800 font-light text-lg mb-2">
                            {{ $user->name ?? 'N/A' }}</td>
                    </tr>

                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 text-gray-900 text-lg font-bold mb-2">
                            Correo :
                        </th>
                        <td class="px-6 py-4 text-gray-800 font-light text-lg mb-2">
                            {{ $user->email ?? 'N/A' }}</td>
                    </tr>

                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 text-gray-900 text-lg font-bold mb-2">
                            Fecha de creación :
                        </th>
                        <td class="px-6 py-4 text-gray-800 font-light text-lg mb-2">
                            {{ $user->created_at ?? 'N/A' }}</td>
                    </tr>

                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 text-gray-900 text-lg font-bold mb-2">
                            Fecha de actualización :
                        </th>
                        <td class="px-6 py-4 text-gray-800 font-light text-lg mb-2">
                            {{ $user->updated_at ?? 'N/A' }}</td>
                    </tr>

                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 text-gray-900 text-lg font-bold mb-2">
                            Último login :
                        </th>
                        <td class="px-6 py-4 text-gray-800 font-light text-lg mb-2">
                            {{ $user->last_login_at ?? 'N/A' }}</td>
                    </tr>

                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 text-gray-900 text-lg font-bold mb-2">
                            Dirección Ip del último login :
                        </th>
                        <td class="px-6 py-4 text-gray-800 font-light text-lg mb-2">
                            {{ $user->last_login_ip ?? 'N/A' }}</td>
                    </tr>

                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 text-gray-900 text-lg font-bold mb-2">
                            Rol :
                        </th>
                        <td class="px-6 py-4 text-gray-800 font-light text-lg mb-2">
                            {{ $user->roles->first()->name ?? 'N/A' }}</td>
                    </tr>

                    <tr class="bg-white border-b">
                        <td colspan="2" class="px-6 py-4 text-lg uppercase font-extralight opacity-90">
                            Permisos
                        </td>
                    </tr>

                    <tr class="bg-white border-b">
                        <td colspan="2" class="px-6 py-4 text-gray-800 font-light text-lg mb-2">
                            <!-- Grid: 1 col en móvil, 2 en sm, 4 en md+ -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                                @foreach ($permissions->groupBy('type') as $group => $perms)
                                    <div>
                                        <h4 class=" text-gray-700 font-semibold mb-2">
                                            {{ ucfirst($group ?? 'General') }}</h4>

                                        <ul class="space-y-1">
                                            @foreach ($perms->sortBy('name') as $permission)
                                                <li class="text-gray-700 text-lg">
                                                    {{ $permission->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Versión móvil: lista estilo perfil -->
        <div class="sm:hidden bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="divide-y divide-gray-200">
                <!-- Información de Perfil - Título -->
                <div class="px-4 py-3 bg-gray-50">
                    <span class="text-sm uppercase font-semibold text-gray-500 tracking-wider">
                        Información de Perfil
                    </span>
                </div>

                <!-- Código -->
                <div class="px-4 py-3">
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-600 text-sm">Código:</span>
                        <span class="text-gray-900 text-sm">{{ $user->code ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Estado -->
                @php
                    $statusName = $user->statusApplication->status->name ?? 'N/A';
                    $statusColors = [
                        'Activo' => 'bg-green-300',
                        'Inactivo' => 'bg-red-300',
                        'N/A' => 'bg-gray-300 text-gray-900',
                    ];
                    $statusClass = $statusColors[$statusName] ?? 'bg-gray-300 text-gray-900';
                @endphp
                <div class="px-4 py-3 border-t border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-600 text-sm">Estado:</span>
                        <div>
                            <span class="px-2 py-1 rounded-md font-medium text-sm {{ $statusClass }}">
                                {{ $statusName }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Nombre -->
                <div class="px-4 py-3 border-t border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-600 text-sm">Nombre:</span>
                        <span class="text-gray-900 text-sm">{{ $user->name ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Correo -->
                <div class="px-4 py-3 border-t border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-600 text-sm">Correo:</span>
                        <span class="text-gray-900 text-sm">{{ $user->email ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Fecha de creación -->
                <div class="px-4 py-3 border-t border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-600 text-sm">Fecha de creación:</span>
                        <span class="text-gray-900 text-sm">{{ $user->created_at ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Fecha de actualización -->
                <div class="px-4 py-3 border-t border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-600 text-sm">Fecha de actualización:</span>
                        <span class="text-gray-900 text-sm">{{ $user->updated_at ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Último login -->
                <div class="px-4 py-3 border-t border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-600 text-sm">Último login:</span>
                        <span class="text-gray-900 text-sm">{{ $user->last_login_at ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Dirección IP del último login -->
                <div class="px-4 py-3 border-t border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-600 text-sm">Dirección IP del último login:</span>
                        <span class="text-gray-900 text-sm">{{ $user->last_login_ip ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Rol -->
                <div class="px-4 py-3 border-t border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-600 text-sm">Rol:</span>
                        <span class="text-gray-900 text-sm">{{ $user->roles->first()->name ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Permisos - Título -->
                <div class="px-4 py-3 bg-gray-50">
                    <span class="text-sm uppercase font-semibold text-gray-500 tracking-wider">
                        Permisos
                    </span>
                </div>

                <!-- Permisos agrupados por tipo en dos columnas -->
                <div class="px-4 py-3">
                    @if ($user->roles->first() && $user->roles->first()->permissions->isNotEmpty())
                        @php
                            $permissions = $user->roles->first()->permissions;
                            $groupedPermissions = $permissions->groupBy('type');
                        @endphp

                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($groupedPermissions as $group => $perms)
                                <div>
                                    <h4 class="text-gray-700 font-semibold text-sm mb-2">
                                        {{ ucfirst($group ?? 'General') }}
                                    </h4>

                                    <ul class="space-y-1">
                                        @foreach ($perms->sortBy('name') as $permission)
                                            <li class="text-gray-600 text-xs">
                                                {{ $permission->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-gray-600 text-sm">Permisos:</span>
                            <span class="text-gray-400 text-sm">Sin permisos asignados</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="mb-3 px-5 md:px-5 mt-2 md:mt-5">
            <x-button-update class="text-ellipsis" href="{{ route('users.edit', $user->id) }}">Editar</x-button-save>
        </div>
    </div>
</x-app-layout>
