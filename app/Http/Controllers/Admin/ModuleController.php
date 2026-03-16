<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Module;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:modulos.ver')->only(['index', 'show']);
        $this->middleware('permission:modulos.crear')->only(['create', 'store']);
        $this->middleware('permission:modulos.editar')->only(['edit', 'update']);
        $this->middleware('permission:modulos.eliminar')->only(['destroy']);
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
        // $statusApplication = StatusApplication::where('applies_to', 'Usuario')
        //     ->where('is_active', true)
        //     ->whereHas('status', function ($q) {
        //         $q->where('code', 'ACTIVO'); // 👈 mejor usar 'code' que 'name'
        //     })
        //     ->first();
        // if (! $statusApplication) {
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

        session()->flash('success', 'El usuario ' . $module->name . ' fue creado correctamente.');
        return redirect()->route('admin.modules.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        //
    }
}
