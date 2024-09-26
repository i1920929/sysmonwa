<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:75'], // Validación para el primer nombre
            'last_name' => ['required', 'string', 'max:50'],  // Validación para el apellido
            'username' => ['required', 'string', 'max:255', 'unique:users'], // Validación para el nombre de usuario
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // Validación para el correo electrónico
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Validación para la contraseña
            'role' => ['required', 'in:Administrador,Usuario'], // Validación para el rol
            'client_id' => ['nullable', 'exists:clients,id'], // Asegura que el cliente existe
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'], // Added username
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'client_id' => $data['client_id'] ?? null, // Se guarda null si no se selecciona cliente
        ]);
    }

    public function showRegistrationForm()
    {
        $clients = Client::all(); // Obtener todos los clientes
        return view('auth.register', ['clients' => $clients]);
    }
}
