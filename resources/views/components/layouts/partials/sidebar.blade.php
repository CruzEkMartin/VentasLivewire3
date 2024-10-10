<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #440412;">
    <!-- Brand Logo -->
    {{-- <a href="{{ route('home') }}" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">
            {{ config('app.name', 'Ventas Livewire 3') }}
        </span>
    </a> --}}
    <div class="brand-link d-flex align-items-center p-2">
        <img src="{{ asset('img/logo_blanco.png') }}" alt="Logo" class="brand-image ">
        <img src="{{ asset('img/Logo_Bienestar.png') }}" alt="Logo" class="brand-text">
    </div>



    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->imagen }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('usuarios.show', auth()->user()) }}" class="d-block"> {{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ $title=='Inicio' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link {{ $title=='Ventas' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Ventas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('ventas.create') }}" class="nav-link">
                                <i class="fas fa-cart-plus nav-icon"></i>
                                <p>Crear venta</p>
                            </a>
                        </li>

                        @if (isAdmin())
                            <li class="nav-item">
                                <a href="{{ route('ventas.list') }}" class="nav-link">
                                    <i class="fas fa-shopping-cart nav-icon"></i>
                                    <p>Mostrar ventas</p>
                                </a>

                            </li>
                        @endif

                    </ul>
                </li>


                @if (isAdmin())
                    <li class="nav-item">
                        <a href="{{ route('categorias') }}" class="nav-link {{ $title=='Categorias' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th-large"></i>
                            <p>
                                Categorias
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('productos') }}" class="nav-link {{ $title=='Productos' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tshirt"></i>
                            <p>
                                Productos
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('clientes') }}" class="nav-link {{ $title=='Clientes' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Clientes
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('usuarios') }}" class="nav-link {{ $title=='Usuarios' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('tienda') }}" class="nav-link {{ $title=='Tienda' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-store-alt"></i>
                            <p>
                                Tienda
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
