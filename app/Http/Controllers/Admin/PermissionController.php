<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PermissionController extends Controller
{
     public function __construct()
    {
        $this->middleware('permission:administracion_permisos.index')->only(['index']);
        $this->middleware('permission:administracion_permisos.show')->only(['show']);
        $this->middleware('permission:administracion_permisos.create')->only(['create', 'store']);
        $this->middleware('permission:administracion_permisos.edit')->only(['edit', 'update']);
        $this->middleware('permission:administracion_permisos.destroy')->only(['destroy']);
    }
    public function index()
    {
        return view('admin.permissions.index');
    }
}
