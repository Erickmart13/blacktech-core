<?php

namespace App\Observers;

use App\Models\Admin\Resource;
use Spatie\Permission\Models\Permission;

class ResourceObserver
{
    /**
     * Handle the Resource "created" event.
     */
    public function created(Resource $resource): void
    {
        $actions = ['index', 'view', 'create', 'edit', 'delete'];
        $moduleCode = $resource->module->code;

        foreach ($actions as $action) {
            Permission::firstOrCreate(
                ['name' => $resource->code . '.' . $action],
                ['type' => $moduleCode]
            );
        }
    }

    /**
     * Handle the Resource "updated" event.
     */
    public function updated(Resource $resource): void
    {
        //
    }

    /**
     * Handle the Resource "deleted" event.
     */
    public function deleted(Resource $resource): void
    {
        //
    }

    /**
     * Handle the Resource "restored" event.
     */
    public function restored(Resource $resource): void
    {
        //
    }

    /**
     * Handle the Resource "force deleted" event.
     */
    public function forceDeleted(Resource $resource): void
    {
        //
    }
}
