<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // use FindsAndChecksModel;
    public function __construct()
    {
        $this->middleware('permission:administracion_usuarios.index')->only(['index']);
        $this->middleware('permission:administracion_usuarios.show')->only(['show']);
        $this->middleware('permission:administracion_usuarios.create')->only(['create', 'store']);
        $this->middleware('permission:administracion_usuarios.edit')->only(['edit', 'update']);
        $this->middleware('permission:administracion_usuarios.destroy')->only(['destroy']);
    }
    public function index(Request $request)
    {
        return view('admin.users.index');
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        $role = Role::all();
        $permissions = $user->getAllPermissions();
        return view('admin.users.show', compact('user', 'role', 'permissions'));
    }

    public function create()
    {
        $roles = Role::all();

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
        // }
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        // // Estado ACTIVO
        // $status = StatusApplication::whereHas('status', fn($q) => $q->where('code', 'ACTIVO'))
        //     ->where('applies_to', 'Usuario')
        //     ->where('is_active', true)
        //     ->firstOrFail();


        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            
            'email_verified_at' => now()
        ]);

        $role = Role::findOrFail($request->role_id);
        $user->assignRole($role->name);

        session()->flash('success', 'El usuario ' . $user->name . ' fue creado correctamente.');
        return redirect()->route('admin.users.index');
    }
    public function edit($id)
    {
        $users = $this->findModelOrRedirect(
            User::class,
            $id,
            'users.index',
            'El cliente que intentas editar ya no existe.',
            // importante para evitar consultas extra
        );

        if ($users instanceof \Illuminate\Http\RedirectResponse) return $users;

        // $statusApplications = StatusApplication::where('applies_to', 'Usuario')->get();


        $roles = Role::all();
        return view('admin.users.edit', compact('users',  'statusApplications', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $users = $this->findModelOrRedirect(
            User::class,
            $id,
            'users.index',
            'El cliente que intentas editar ya no existe.',
        );

        if ($users instanceof \Illuminate\Http\RedirectResponse) return $users;

        // Concurrencia
        if ($redirect = $this->checkOptimisticConcurrency(
            $users,
            $request->input('updated_at'),
            'users.edit',
            'Este Usuario fue modificado por otro usuario. Por favor revisa los cambios antes de guardar.',
            ['user' => $users->id]
        )) {
            return $redirect;
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$id}",
            'password' => 'confirmed',
            'role_id' => 'required|exists:roles,id',

        ]);

        $users->update([

            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status_application_id' => $request->status_application_id,
        ]);

        $roleName = Role::find($request->role_id)?->name;

        if ($roleName) {
            $users->syncRoles([$roleName]);
        }

        return redirect()->route('users.index')
            ->with('success', 'El usuario ' . $users->name . ' actualizado correctamente.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $userName = $user->name;
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', "El usuario  $userName ha sido eliminado correctamente.");
    }
}
