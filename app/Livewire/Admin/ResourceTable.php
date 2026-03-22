<?php

namespace App\Livewire\Admin;

use App\Models\Admin\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class ResourceTable extends PowerGridComponent
{
    public string $tableName = 'resourceTable';

    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Resource::query()

            ->leftJoin('resources as parents', function ($join) {
                $join->on('resources.parent_id', '=', 'parents.id');
            })
            ->join('modules', function ($join) {
                $join->on('resources.module_id', '=', 'modules.id');
            })
            ->select([
                'resources.*',
                'modules.name as module_name',   // nombre del módulo
                'parents.name as parent_name',   // nombre del padre
            ])

            ->orderBy('resources.order');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('module_id')
            ->add('module_name')
            ->add('parent_id')
            ->add('parent_name')
            ->add('name')
            ->add('code')
            ->add('route')
            ->add('icon')
            ->add('order')
            ->add('is_active')
            ->add('created_by')
            ->add('updated_by')
            ->add('created_at')
            ->add('created_at_formatted', function ($model) {
                return Carbon::parse($model->created_at)->format('Y-m-d');
            });;
    }

    public function columns(): array
    {
        return [
            // Column::make('Id', 'id'),
            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Padre', 'parent_name', 'parents.name')
                ->sortable()
                ->searchable(),
            Column::make('Módulo', 'module_name', 'modules.name')
                ->sortable()
                ->searchable(),
            Column::make('Orden', 'order')
                ->sortable()
                ->searchable(),

            Column::make('Estado', 'is_active')
                ->sortable()
                ->searchable()
                ->toggleable(),

            Column::make('Fecha Creación', 'created_at_formatted', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Acciones')
        ];
    }

    public function beforeSearchIsActive($search)
    {
        return match (strtolower(trim($search))) {
            'activo' => '1',
            'inactivo' => '0',
            default => $search,
        };
    }

    public function onUpdatedToggleable(string|int $id, string $field, string $value): void
    {
        Resource::query()->find($id)->update([
            $field => e($value),
        ]);
    }

    public function filters(): array
    {
        return [];
    }



    public function actions(Resource $row): array
    {
        $buttons = [];
        /** @var \App\Models\Amin\User $user */
        $user = Auth::user();
        //Solo mostrar si el usuario tiene permiso de ver
        if ($user && $user->can('recursos.ver')) {
            $buttons[] = Button::add('show')
                ->id()
                ->class('relative group py-1.5 cursor-pointer hover:-translate-y-px bg-clip-text')
                ->slot(
                    '<div class="inline-flex items-center justify-center px-1 py-1 rounded-md bg-blue-500 text-slate-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>
                    <span class="absolute left-1/2 -translate-x-1/2 -top-4 px-2 py-0.5 text-xs text-white bg-gray-700 rounded opacity-0 group-hover:opacity-100 transition">
                        Ver
                    </span>'
                )
                ->route('admin.resources.show', ['resource' => $row->id]);
        }
        //Solo mostrar si el usuario tiene permiso de editar
        if ($user && $user->can('recursos.editar')) {
            $buttons[] = Button::add('edit')
                ->id()
                ->class('relative group py-1.5 cursor-pointer hover:-translate-y-px bg-clip-text')
                ->slot(
                    '<div class="inline-flex items-center justify-center px-1 py-1 rounded-md bg-green-700 text-slate-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </div>
                        <span class="absolute left-1/2 -translate-x-1/2 -top-4 px-2 py-0.5 text-xs text-white bg-gray-700 rounded opacity-0 group-hover:opacity-100 transition">
                        Editar
                        </span>'
                )
                ->route('admin.resources.edit', ['resource' => $row->id]);
        }
        // Solo mostrar si el usuario tiene permiso para eliminar
        if ($user && $user->can('recursos.eliminar')) {
            $buttons[] =  Button::add('destroy')
                ->id()
                ->class('relative group py-1.5 cursor-pointer hover:-translate-y-px bg-clip-text')
                ->attributes([
                    'onclick' => "openModal('delete-record', {$row->id}, '" . route('admin.resources.destroy', $row->id) . "')",
                    'type'    => 'button',
                ])
                ->slot(
                    '<div class="inline-flex items-center justify-center px-1 py-1 rounded-md bg-red-600 text-slate-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </div>
                    <span class="absolute left-1/2 -translate-x-1/2 -top-4 px-2 py-0.5 text-xs text-white bg-gray-700 rounded opacity-0 group-hover:opacity-100 transition">
                    Eliminar
                    </span>'
                );
        }
        return $buttons;
    }
}
