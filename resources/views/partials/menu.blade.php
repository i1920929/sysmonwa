<!-- resources/views/partials/menu.blade.php -->

    <div class="containers">
        <div class="sidebar">
            <div class="sidebaruno">
                <div class="logo">
                    <div class="logo-img">
                        <img src="../../img/logo.png" alt="">
                    </div>
                </div>

                <div class="logo">
                    <div class="user-img">
                    @if(Auth::check() && Auth::user()->profile_image)
                        <img src="{{ asset('images/' . Auth::user()->profile_image) }}" alt="Imagen de perfil">
                    @else
                        <img src="../../img/user.png" alt="Imagen de perfil por defecto">
                    @endif
                    </div>
                </div>

                <div class="head">
                    <div class="user-details">
                        <p class="name">{{ Auth::user()->username }}</p>
                        <p class="role">{{ Auth::user()->role }}</p>
                    </div>
                </div>
                <a href="{{ route('users.edit', Auth::id()) }}">
                    <i class="icon"></i>
                    <span class="text">Editar Perfil</span>
                </a>

            </div>
            <div class="nav">
                <div class="menu">
                    <p class="title">Menú</p>
                    <ul>
                    @auth
                            @if(Auth::user()->role !== 'Usuario')
                                <li class="active">
                                    <a href="#">
                                        <img src="../../img/icon-admin.png" alt="">
                                        <span class="text">Administración</span>
                                        <i class="arrow ph-bold ph-caret-down"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="{{ route('users.index') }}">
                                                <span class="text">Usuarios</span>
                                            </a>
                                            <a href="{{ route('clients.index') }}">
                                                <span class="text">Clientes</span>
                                            </a>
                                            <a href="{{ route('tanques.index') }}">
                                                <span class="text">Tanques</span>
                                            </a>
                                            <a href="{{ route('sensors.index') }}">
                                                <span class="text">Sensores</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endauth
                        <li>
                            <a href="#">
                                <img src="../../img/icon-consumo.png" alt="">
                                <span class="text">Consumo</span>
                                <i class="arrow ph-bold ph-caret-down"></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#">
                                        <span class="text">En tiempo real</span>
                                    </a>
                                    <a href="#">
                                        <span class="text">Histórico</span>
                                    </a>
                                    <a href="#">
                                        <span class="text">Predicción</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                            <img src="../../img/icon-nivel.png" alt="">
                                <span class="text">Nivel</span>
                                <i class="arrow ph-bold ph-caret-down"></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#">
                                        <span class="text">En tiempo real</span>
                                    </a>
                                    <a href="#">
                                        <span class="text">Histórico</span>
                                    </a>
                                    <a href="#">
                                        <span class="text">Predicción</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <img src="../../img/icon-calidad.png" alt="">
                                <span class="text">Calidad</span>
                                <i class="arrow ph-bold ph-caret-down"></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#">
                                        <span class="text">En tiempo real</span>
                                    </a>
                                    <a href="#">
                                        <span class="text">Histórico</span>
                                    </a>
                                    <a href="#">
                                        <span class="text">Predicción</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <img src="../../img/icon-home.png" alt="">
                                <span class="text">Inicio</span>
                            </a>
                        </li>
                        <li>

                            <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                      <img src="../../img/icon-salir.png" alt="">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                        </li>
                    </ul>


                </div>
            </div>
        </div>
    </div>
