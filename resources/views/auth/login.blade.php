@extends('layouts.app')
@section('content')
    <main>
        <div class="login-container">
            <form action="{{ route('login') }}" method="POST" class="login-form">
                @csrf <!-- Protección contra CSRF -->
                
                <h2>Iniciar Sesión</h2>
                <img src="../../img/separador.png" alt="Separador visual">
                
                <!-- Usuario/Email -->
                <label for="email">Usuario</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <!-- Contraseña -->
                <label for="password">Contraseña</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <!-- Opción "Recordarme" -->
                <div class="remember-me">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Recordarme</label>
                </div>
                
                <!-- Enlace a "¿Olvidaste tu contraseña?" -->
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
                
                <!-- Botón de Iniciar Sesión con icono de Login -->
                <button type="submit" class="login-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="lock-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V7a3 3 0 116 0v4m-9 4h10m2 0a2 2 0 01-2 2H8a2 2 0 01-2-2v-4a2 2 0 012-2h8a2 2 0 012 2v4z"/>
                    </svg> Iniciar Sesión
                </button>
            </form>
        </div>
    </main>
@endsection
