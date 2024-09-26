<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Display a listing of the users
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->paginate(10); // Cambia 10 por el número de elementos por página que desees

        return view('users.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        $clients = Client::all(); // Asegúrate de tener la clase Client importada
         return view('users.create', compact('clients'));
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        // Validar los datos de entrada, incluida la imagen
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:Usuario,Administrador',
            'client_id' => 'nullable|exists:clients,id', // Asegura que el cliente exista
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Validar imagen (opcional)
        ]);
    
        // Si hay errores de validación, redirigir con los errores y los datos ingresados
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Manejar la subida de la imagen de perfil
        $profileImage = null;
        if ($request->hasFile('profile_image')) {
            // Obtener la imagen y generar un nombre único basado en el tiempo
            $image = $request->file('profile_image');
            $profileImage = time() . '.' . $image->getClientOriginalExtension();
    
            // Mover la imagen a la carpeta 'public/images'
            $image->move(public_path('images'), $profileImage);
        }
    
        // Crear un nuevo usuario
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash de la contraseña
            'role' => $request->role,
            'client_id' => $request->client_id, // Guardar el ID del cliente si es seleccionado
            'profile_image' => $profileImage, // Guardar el nombre de la imagen (si fue subida)
        ]);
    
        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }
    

     // Mostrar el formulario de edición
    public function edit($id)
    {
        // Obtener el usuario por ID
        $user = User::findOrFail($id);
        
        // Obtener la lista de clientes
        $clients = Client::all();
        
        // Retornar la vista de edición con el usuario y clientes
        return view('users.edit', compact('user', 'clients'));
    }

    // Actualizar el usuario
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:Usuario,Administrador',
            'client_id' => 'nullable|exists:clients,id', // Asegúrate que el cliente exista
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validar imagen de perfil
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Manejar la subida de una nueva imagen de perfil
        if ($request->hasFile('profile_image')) {
            // Borrar la imagen anterior si existe
            if ($user->profile_image && file_exists(public_path('images/' . $user->profile_image))) {
                unlink(public_path('images/' . $user->profile_image));
            }

            // Guardar la nueva imagen
            $profileImage = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('images'), $profileImage);

            // Actualizar el campo de la imagen de perfil
            $user->profile_image = $profileImage;
        }

        // Actualizar otros campos del usuario
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Si se cambia la contraseña
        }

        if (Auth::user()->role === 'Administrador') {
            $user->role = $request->role;
            $user->client_id = $request->client_id;
        }

        $user->save();

        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }
    // Remove the specified user from storage
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
    public function show($id)
    {
        // Obtener el usuario por ID
        $user = User::findOrFail($id);
        
        // Retornar la vista de detalles con el usuario
        return view('users.show', compact('user'));
    }
}