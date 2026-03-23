<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Module;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:administracion_modulos.index')->only(['index']);
        $this->middleware('permission:administracion_modulos.show')->only(['show']);
        $this->middleware('permission:administracion_modulos.create')->only(['create', 'store']);
        $this->middleware('permission:administracion_modulos.edit')->only(['edit', 'update']);
        $this->middleware('permission:administracion_modulos.destroy')->only(['destroy']);
    }

    public function index()
    {

        return view('admin.modules.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        // // Verificar que exista al menos un estado "Activo" para Cliente
        //  $moduleApplication = StatusApplication::where('applies_to', 'Usuario')
        //     ->where('is_active', true)
        //     ->whereHas('status', function ($q) {
        //         $q->where('code', 'ACTIVO'); // 👈 mejor usar 'code' que 'name'
        //     })
        //     ->first();
        // if (! $moduleApplication) {
        //     return redirect()
        //         ->route('users.index') // o a donde quieras redirigir
        //         ->with('warning', 'Deben existir el estado Activo asigando a Cliente, por favor asigne dicho estado para registrar un cliente.');

        return view('admin.modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',

        ]);

        // // Estado ACTIVO
        // $status = StatusApplication::whereHas('status', fn($q) => $q->where('code', 'ACTIVO'))
        //     ->where('applies_to', 'Usuario')
        //     ->where('is_active', true)
        //     ->firstOrFail();

        $module = Module::create([
            'name'     => $request->name,

        ]);

        session()->flash('success', 'El módulo ' . $module->name . ' fue creado correctamente.');
        return redirect()->route('admin.modules.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $module = Module::findOrFail($id);

        return view('admin.modules.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {
        $module = Module::findOrFail($id);
        return view('admin.modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $module = Module::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('modules', 'name')->ignore($module->id),
            ],
            'order' => [
                'required',
                'numeric',
            ],
            'is_active' => 'required|boolean',
        ]);

        $module->update([
            'name' => $request->name,
            'order' => $request->order,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('admin.modules.index')
            ->with('success', 'El módulo ' .  $module->name . ' fue actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $module = Module::findOrFail($id);
        $name = $module->name;

        $module->delete();
        return redirect()->back()->with('success', "El módulo {$name} fue eliminado exitosamente");
    }
}
