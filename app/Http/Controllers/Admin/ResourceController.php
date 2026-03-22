<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Module;
use App\Models\Admin\Resource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.resources.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = Module::orderBy('order')->get();

        // Si hay un módulo seleccionado, filtra por él, si no, muestra todos los posibles padres
        $parents = collect();

        return view('admin.resources.create', compact('modules', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $request->validate([
            'module_id' => ['required', 'exists:modules,id'],
            'parent_id' => ['nullable', 'exists:resources,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50'],
            'icon' => 'nullable|string|max:255',
        ]);

        $resource = Resource::create([
            'module_id' => $request->module_id,
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'code' => $request->code,
            'route' => $request->route,
            'icon' => $request->icon,
            'order' => $request->order,


        ]);
        session()->flash('success', 'El tipo de recursos ' . $resource->name . ' fue creado correctamente');
        return redirect()->route('admin.resources.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        //
    }
}
