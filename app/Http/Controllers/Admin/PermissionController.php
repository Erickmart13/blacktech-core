<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permissions.index');
    }
}
