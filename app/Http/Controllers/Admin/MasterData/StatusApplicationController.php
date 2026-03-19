<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Models\Admin\MasterData\Status;
use App\Models\Admin\MasterData\StatusApplication;
use App\Models\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StatusApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        // Inicio y Ver
        $this->middleware('permission:estadosAsignar.ver')->only('index', 'show');
        // Crear 
        $this->middleware('permission:estadosAsignar.crear')->only('create', 'store');
        // Editar 
        $this->middleware('permission:estadosAsignar.editar')->only('edit', 'update');
        // Eliminar 
        $this->middleware('permission:estadosAsignar.eliminar')->only('destroy');
    }

    public function index()
    {
        return view('admin.master-data.status-applications.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entities = [

            // Entidades generales 
            'Usuario',
            'Cliente',
            'Intermediario',
            'Beneficiario',
            'Proveedor',
            'Empleado',
            'Producto',

            //Procesos y trámites administrativos
            'Solicitud',
            'Proceso',
            'Aplicación',
            'Aprobación',
            'Documento',
            'Permiso',
            'Licencia',
            'Formulario',
            'Inspección',
            'Registro',

            //Procesos operativos
            'Orden',
            'Ticket',
            'Incidente',
            'Tarea',
            'Proyecto',
            'Informe',
            'Cotización',
            'Contrato',
            'Factura',
            'Pago',
            'Egreso',
            'Envío',
            'Entrega',
            //Otros posibles procesos
            'Evaluación',
            'Capacitación',
            'Reclamo',
            'Devolución',
            'Visita',
            'Llamada',
        ];
        $statuses = Status::all();
        return view('admin.master-data.status-applications.create', compact('statuses', 'entities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'applies_to' => 'required|string',
            'status_id' => 'required|exists:statuses,id',
        ]);
        // Evitar duplicados
        $exists = StatusApplication::where('status_id', $validated['status_id'])
            ->where('applies_to', $validated['applies_to'])
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'applies_to' => 'Este estado ya ha sido asignado a esta entidad.',
            ])->withInput();
        }

        $statusApplication = StatusApplication::create([
            'applies_to' => $request->applies_to,
            'status_id' => $request->status_id,
            'is_active' => 1,
        ]);
        $statusApplication->load('status');


        // Mensaje
        $statusName = $statusApplication->status->name;
        $entidad = $statusApplication->applies_to;
        session()->flash('success', 'Estado ' . $statusName . ' ha sido asignado a la entidad ' . $entidad . ' correctamente.');

        return redirect()->route('admin.master-data.status-applications.index');
    }
    /**
     * Display the specified resource.
     */
     public function show($id)
    {
        $statusApplication = StatusApplication::findOrFail($id);

        return View('admin.master-data.status-applications.show', compact('statusApplication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $statusApplication = StatusApplication::findOrFail($id);

        $entities = [

            // Entidades generales 
            'Usuario',
            'Cliente',
            'Intermediario',
            'Beneficiario',
            'Proveedor',
            'Empleado',
            'Producto',

            //Procesos y trámites administrativos
            'Solicitud',
            'Proceso',
            'Aplicación',
            'Aprobación',
            'Documento',
            'Permiso',
            'Licencia',
            'Formulario',
            'Inspección',
            'Registro',

            //Procesos operativos
            'Orden',
            'Ticket',
            'Incidente',
            'Tarea',
            'Proyecto',
            'Informe',
            'Cotización',
            'Contrato',
            'Factura',
            'Pago',
            'Egreso',
            'Envío',
            'Entrega',
            //Otros posibles procesos
            'Evaluación',
            'Capacitación',
            'Reclamo',
            'Devolución',
            'Visita',
            'Llamada',
        ];
        $statuses = Status::all();

        return view('admin.master-data.status-applications.edit', compact('statusApplication', 'statuses', 'entities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $statusApplication = StatusApplication::findOrFail($id);
        $validated = $request->validate([
            'applies_to' => 'required|string',
            'status_id' => 'nullable|exists:statuses,id',
            'is_active' => 'required|boolean'
        ]);
        // Evitar duplicados
        $exists = StatusApplication::where('status_id', $validated['status_id'])
            ->where('applies_to', $validated['applies_to'])
            ->where('id', '!=', $statusApplication->id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'applies_to' => 'Este estado ya ha sido asignado a esta entidad.',
            ])->withInput();
        }

        $statusApplication->update([
            'applies_to' => $request->applies_to,
            'status_id' => $request->status_id,
            'is_active' => $request->is_active,
        ]);
        $statusApplication->load('status');

        // Mensaje
        $statusName = $statusApplication->status->name;
        $entidad = $statusApplication->applies_to;
        session()->flash('success', 'El estado ' . $statusName . ' de la entidad ' . $entidad . ' ha sido actualizado correctamente.');

        return redirect()->route('admin.master-data.status-applications.index');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $statusApplication = StatusApplication::findOrFail($id);
        $nameEntidad = $statusApplication->applies_to;

        // Determinar dónde podría estar en uso
        $usedIn = [];

        if ($nameEntidad === 'Cliente') {
            $count = User::where('status_application_id', $statusApplication->id)->count();
            if ($count > 0) $usedIn[] = "Clientes";
        }
        // if ($nameEntidad === 'Intermediario') {
        //     $count = Intermediary::where('status_application_id', $statusApplication->id)->count();
        //     if ($count > 0) $usedIn[] = "Intermediarios";
        // }
        // if ($nameEntidad === 'Beneficiario') {
        //     $count = Beneficiary::where('status_application_id', $statusApplication->id)->count();
        //     if ($count > 0) $usedIn[] = "Beneficiario";
        // }

        // Agrega aquí otros módulos si aplican
        // if ($nameEntidad === 'order') { ... }

        // Si se está usando en algún módulo, no borramos y mostramos mensaje
        // if (!empty($usedIn)) {
        //     $modules = implode(', ', $usedIn);
        //     return redirect()->back()->with(
        //         'error',
        //         "No se puede eliminar la asiganación de estado de la entidad {$nameEntidad} porque está siendo utilizado en: {$modules}."
        //     );
        // }

        try {
            $statusApplication->delete();
            return redirect()->back()->with(
                'success',
                "El registro {$nameEntidad} fue eliminado exitosamente"
            );
        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                "Ocurrió un error inesperado al intentar eliminar {$nameEntidad}."
            );
        }
    }
}
