<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkSession;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('workSessions') // Eager Loading de las jornadas
            ->where('admin_id', Auth::id()); // Filtrar solo usuarios asignados al admin actual

        // Aplicar búsqueda si se proporciona
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->paginate(10);

        return view('admin.users.index', compact('users'));
    }




    public function create()
    {
        return view('admin.users.create'); // Mostrar formulario para crear un usuario
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'dni' => 'required|regex:/^[0-9]{7,8}[A-Za-z]?$/|unique:users,dni',
            'role' => 'required|string|in:admin,user',
            'password' => 'required|digits:4|confirmed',
        ]);

        // Calcular automáticamente la letra del DNI si no se proporciona
        $dniWithoutLetter = substr($request->input('dni'), 0, 8);
        $calculatedLetter = self::calculateDNILetter($dniWithoutLetter);
        $validatedDni = $dniWithoutLetter . $calculatedLetter;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'dni' => $validatedDni,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'admin_id' => Auth::id(),
        ]);

        return redirect()->route('users.index')->with('status', 'Usuario creado con éxito.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user')); // Mostrar formulario de edición
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'dni' => 'required|regex:/^[0-9]{7}[A-Z]$/|unique:users,dni,' . $user->id,
            'role' => 'required|string|in:admin,user',
        ]);

        $user->update($request->only('name', 'email', 'dni', 'role'));

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
    public static function calculateDNILetter($dni)
    {
        $letters = "TRWAGMYFPDXBNJZSQVHLCKE";
        return $letters[$dni % 23];
    }



}

