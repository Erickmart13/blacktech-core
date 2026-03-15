<x-app-layout>
    @section('page-title', 'Administración - Roles')

    <div class="flex p-4 mr-4 pl-6 px-3 gap-2 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="text-purple-500 size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
        </svg>
        <h2 class="text-lg font-bold">Ver Rol</h2>
        <x-button-retorn class="ml-auto" href="{{ route('roles.index') }}">Regresar</x-button>
    </div>

    <div class="border-2 p-2 lg:mx-5 shadow-xl">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <tbody>
                    <tr class="bg-gray-100">
                        <td colspan="2" class="px-6 py-4 text-lg uppercase font-extralight opacity-90">
                            Información del Rol
                        </td>
                    </tr>

                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 text-gray-900 text-lg font-bold mb-2">
                            Rol :
                        </th>
                        <td class="px-6 py-4 text-gray-800 font-light text-lg mb-2">
                            {{ $roles->name ?? 'N/A' }}</td>
                    </tr>

                    <tr class="bg-gray-100">
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

        <div class="mb-3 px-5 md:px-5 mt-2 md:mt-5">
            <x-button-update class="text-ellipsis" href="{{ route('roles.edit', $roles->id) }}">Editar</x-button-save>
        </div>
    </div>
</x-app-layout>
