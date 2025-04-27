<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-pop Dtb</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome (opcional, para íconos) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        .navbar-custom {
            background-color: #604652; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            color: #cf9292!important; /* Color amarillo al hacer hover */
        }
        .btn-logout {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.75);
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            color: !important;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <body>
        <!-- Navbar Morada -->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container">
                <!-- Logo y Nombre de la Aplicación -->
                <a class="navbar-brand" href="{{ url('/') }}" style="color: #D4C9BE">
                    <i class="fas fa-music"></i> K-pop Dtb
                </a>
    
                <!-- Botón para Menú en Dispositivos Móviles -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <!-- Menú de Navegación -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Menú para Usuarios Autenticados (solo visible en rutas protegidas) -->
                    @auth
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('groups.index') }}" style="color: #D4C9BE;">
                                    <i class="fas fa-users"></i> Grupos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('members.index') }}" style="color: #D4C9BE;">
                                    <i class="fas fa-user-friends"></i> Integrantes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('albums.index') }}" style="color: #D4C9BE;">
                                    <i class="fas fa-compact-disc"></i> Álbumes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('songs.index') }}" style="color: #D4C9BE;">
                                    <i class="fas fa-music"></i> Canciones
                                </a>
                            </li>
                        </ul>
                    @endauth
    
                    <!-- Menú Derecho (Login/Registro o Cerrar Sesión) -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <!-- Usuario autenticado: Mostrar solo Cerrar Sesión -->
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn-logout" style="color: #D4C9BE;">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        @else
                            <!-- Usuario NO autenticado: Mostrar solo Login/Registro -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus"></i> Registrarse
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    
        <!-- Contenido Principal -->
        <div class="container mt-5 pt-4">
            @yield('content')
        </div>
    
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>