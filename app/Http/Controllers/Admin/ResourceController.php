<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Module;
use App\Models\Admin\Resource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('resources')
                    ->where(fn($q) => $q->where('module_id', $request->module_id)),
            ],
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
    public function show($id)
    {
        $resource = Resource::findOrFail($id);
        return view('admin.resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        $modules = Module::orderBy('order')->get();

        // Traemos todos los posibles padres dentro del mismo módulo, excluyendo el recurso actual
        $parents = Resource::where('module_id', $resource->module_id)
            ->where('id', '<>', $resource->id)
            ->orderBy('order')
            ->get();

        return view('admin.resources.edit', compact('resource', 'modules', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        $request->validate([
            'module_id' => ['required', 'exists:modules,id'],
            'parent_id' => ['nullable', 'exists:resources,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('resources')
                    ->where(fn($q) => $q->where('module_id', $request->module_id))
                    ->ignore($resource->id),
            ],
            'icon' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        // Evitar que se ponga a sí mismo como padre
        if ($request->parent_id == $resource->id) {
            return redirect()->back()
                ->withErrors(['parent_id' => 'El recurso no puede ser su propio padre'])
                ->withInput();
        }

        $resource->update([
            'module_id' => $request->module_id,
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'route' => $request->route,
            'icon' => $request->icon,
            'order' => $request->order,
            'is_active' => $request->is_active,
        ]);

        session()->flash('success', 'El tipo de recurso ' . $resource->name . ' fue actualizado correctamente');

        return redirect()->route('admin.resources.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {

        $name = $resource->name;

        $resource->delete();
        return redirect()->back()->with('success', "El recurso {$name} fue eliminado exitosamente");
    }
}
