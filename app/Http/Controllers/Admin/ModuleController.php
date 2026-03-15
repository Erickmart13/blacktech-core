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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
