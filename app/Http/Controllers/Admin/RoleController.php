<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Module;
use App\Models\Admin\Resource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $resources = Resource::all();
        $module = Module::all();
        $permissions = Permission::all()->groupBy('type')->map(function ($group) {
            return $group->groupBy(function ($permission) {
                return explode('.', $permission->name)[0];
            });
        });
        return view('admin.roles.create', compact('permissions', 'module', 'resources'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array'
        ]);

        $roles = Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        $roles->syncPermissions($request->permissions);

        session()->flash('success', 'El rol ' . $roles->name . ' fue agregado correctamente');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $roles = Role::findOrFail($id);
        $permissions = Permission::all()->groupBy('type')->map(function ($group) {
            return $group->groupBy(function ($permission) {
                return explode('.', $permission->name)[0];
            });
        });
        return view('admin.roles.show', compact('roles', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $resources = Resource::all();
        $module = Module::all();
        $permissions = Permission::all()->groupBy('type')->map(function ($group) {
            return $group->groupBy(function ($permission) {
                return explode('.', $permission->name)[0];
            });
        });
        return view('admin.roles.edit', compact('role', 'permissions', 'module', 'resources'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $roles = Role::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
            'is_active' => 'required|boolean',
        ]);

        $roles->update([
            'name' => $request->name,
            'is_active' => $request->is_active,

        ]);

        $roles->syncPermissions($request->permissions);

        session()->flash('success', 'El rol ' . $roles->name . ' fue actualizado correctamente');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Obtener el rol
        $roles = Role::findOrFail($id);
        $roleName = $roles->name;

        // Eliminar relaciones manualmente (opcional, Spatie lo maneja al usar $role->delete())
        $roles->permissions()->detach(); // Quita permisos asignados al rol
        $roles->users()->detach();       // Quita asignaciones a usuarios (model_has_roles)

        // Eliminar el rol
        $roles->delete();


        return redirect()->back()->with('success', "El rol {$roleName} fue eliminado exitosamente");
    }
}
