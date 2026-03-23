<?php

namespace App\Livewire\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use Spatie\Permission\Models\Permission;

final class PermissionTable extends PowerGridComponent
{
    public string $tableName = 'permissionTable';

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
        return Permission::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('created_at')
            ->add('is_active')
            ->add('status_label', fn($model) => $model->is_active ? 'Activo' : 'Inactivo')
            ->add('created_at_formatted', function ($model) {
                return Carbon::parse($model->created_at)->format('Y-m-d');
            })
            ->add('updated_at_formatted', function ($model) {
                return Carbon::parse($model->updated_at)->format('Y-m-d');
            });
    }

    public function columns(): array
    {
        return [
            // Column::make('Id', 'id'),
            Column::make('Tipo', 'type')
                ->sortable()
                ->searchable(),

            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Fecha Creación', 'created_at_formatted', 'created_at')
                ->sortable()
                ->searchable(),
            Column::make('Fecha Actualización', 'updated_at_formatted', 'updated_at')
                ->sortable()
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [];
    }
}
