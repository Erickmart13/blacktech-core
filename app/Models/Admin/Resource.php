<?php

namespace App\Models\Admin;

use App\Concerns\GeneratesCode;
use App\Concerns\HasAuditable;
use App\Concerns\HasOrder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Resource extends Model
{
    use HasOrder;
    use HasAuditable;
    use GeneratesCode;

    protected $fillable = [
        'module_id',
        'parent_id',
        'name',
        'code',
        'route',
        'icon',
        'order',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function generatePermissions()
    {
        $actions = ['index', 'show', 'create', 'edit', 'destroy'];

        foreach ($actions as $action) {
            Permission::firstOrCreate(
                ['name' => $this->code . '.' . $action],
                ['type' => $this->module->code]
            );
        }
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    // 🔗 módulo
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    // 🔗 padre
    public function parent()
    {
        return $this->belongsTo(Resource::class, 'parent_id');
    }

    // 🔗 hijos
    public function children()
    {
        return $this->hasMany(Resource::class, 'parent_id')->ordered();
    }

    public static function tree($moduleId)
    {
        $resources = self::where('module_id', $moduleId)
            ->orderBy('order')
            ->get();

        return self::buildTree($resources);
    }

    protected static function buildTree($resources, $parentId = null, $level = 0)
    {
        $tree = [];

        foreach ($resources->where('parent_id', $parentId) as $resource) {
            $resource->level = $level; // nivel para la indentación
            $tree[] = $resource;

            // Recursivamente agregamos hijos
            $tree = array_merge($tree, self::buildTree($resources, $resource->id, $level + 1));
        }

        return $tree;
    }
}
