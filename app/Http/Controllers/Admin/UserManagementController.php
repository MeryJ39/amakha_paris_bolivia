<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

    class UserManagementController extends Controller
    {
        // Mostrar todos los usuarios con sus roles
        public function index()
        {
            // Obtén todos los usuarios con su relación de roles
            $users = User::with('role')->paginate(10);
            return view('admin.users.index', compact('users'));
        }

        // Mostrar formulario para crear un usuario
        public function create()
        {
            $roles = Role::all(); // Obtener todos los roles
            return view('admin.users.create', compact('roles'));
        }

        // Guardar un nuevo usuario
        public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'phone' => 'nullable|string|max:15',
                'role_id' => 'required|exists:roles,id',
            ]);

            $validated['password'] = bcrypt($validated['password']);

            User::create($validated);

            return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente');
        }

        // Mostrar el formulario para editar un usuario
        public function edit(User $user)
        {
            $roles = Role::all(); // Obtener todos los roles
            return view('admin.users.edit', compact('user', 'roles'));
        }

        // Actualizar un usuario existente
        public function update(Request $request, User $user)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:15',
                'role_id' => 'required|exists:roles,id',
            ]);

            // Actualizar la contraseña solo si se proporciona
            if ($request->filled('password')) {
                $validated['password'] = bcrypt($request->password);
            }

            $user->update($validated);

            return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente');
        }

        // Eliminar un usuario
        public function destroy(User $user)
        {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente');
        }

        // Mostrar el formulario para editar un rol
        public function editRole(Role $role)
        {
            return view('admin.roles.edit', compact('role'));
        }

        // Actualizar un rol
        public function updateRole(Request $request, Role $role)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $role->update($validated);

            return redirect()->route('admin.users.index')->with('success', 'Rol actualizado exitosamente');
        }

        // Mostrar todos los roles
        public function indexRoles()
        {
            $roles = Role::paginate(10); // Paginación de roles (10 roles por página)
            return view('admin.roles.index', compact('roles'));
        }


    }