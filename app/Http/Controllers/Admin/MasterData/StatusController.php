<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Models\Admin\MasterData\Status;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StatusController extends Controller
{
    public function __construct()
    {
        // Inicio y Ver
        $this->middleware('permission:estados.ver')->only('index', 'show');
        // Crear 
        $this->middleware('permission:estados.crear')->only('create', 'store');
        // Editar 
        $this->middleware('permission:estados.editar')->only('edit', 'update');
        // Eliminar 
        $this->middleware('permission:estados.eliminar')->only('destroy');
    }
    public function index(Request $request)
    {
        return view('admin.master-data.statuses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('statuses', 'name')
            ],
        ]);

        $status = Status::create([
            'name' => $request->name,

        ]);

        session()->flash('success', 'El tipo de estado ' . $status->name . ' fue creado correctamente');
        return redirect()->route('admin.master-data.statuses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $status = Status::findOrFail($id);

        return View('admin.master-data.statuses.show', compact('status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $status = Status::findOrFail($id);
        return view('admin.master-data.statuses.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $status = Status::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('statuses', 'name')->ignore($status->id),
            ],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('statuses', 'code')->ignore($status->id),
            ],
            'is_active' => 'required|boolean',
        ]);

        $status->update([
            'name' => $request->name,
            'code' => $request->code,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('admin.master-data.statuses.index')
            ->with('success', 'El tipo de estado ' . $status->name . ' fue actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $name = $status->name;

        // Verificar si tiene aplicaciones asociadas
        $applications = $status->statusApplication()->pluck('applies_to')->toArray();

        if (count($applications) > 0) {
            $modules = implode(', ', $applications);
            return redirect()->back()->with(
                'error',
                "No se puede eliminar el estado {$name} porque ha sido asignado a la entidad: {$modules}."
            );
        }

        try {
            $status->delete();
            return redirect()->back()->with('success', "El registro {$name} fue eliminado exitosamente");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Ocurrió un error inesperado al intentar eliminar {$name}. {$e->getMessage()}");
        }
    }
}
