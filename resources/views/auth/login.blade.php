@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
                <!-- Encabezado del formulario -->
                <div class="card-header py-3" style="background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%); position: relative;">
                    <img src="{{ asset('assets/BTS2.jpeg') }}"  style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.4 ;">
                    <div class="text-center">
                        <i class="fas fa-user-lock fa-3x text-white mb-3" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3);"></i>
                        <h2 class="text-white mb-1" style="font-weight: 800;">¡Bienvenido!</h2>
                        <p class="text-white mb-0" style="opacity: 0.8;">Ingresa a tu cuenta para Acceder</p>
                    </div>
                </div>
                
                <!-- Cuerpo del formulario -->
                <div class="card-body p-5" style="background-color: #f8f9fa;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Campo Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label" style="color: #495057; font-weight: 600;">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #fff; border-right: none;">
                                    <i class="fas fa-envelope" style="color: #97866A;"></i>
                                </span>
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                       style="border-left: none; border-color: #ddd; border-radius: 0 10px 10px 0;">
                            </div>
                            @error('email')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Contraseña -->
                        <div class="mb-4">
                            <label for="password" class="form-label" style="color: #495057; font-weight: 600;">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #fff; border-right: none;">
                                    <i class="fas fa-lock" style="color: #97866A;"></i>
                                </span>
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="current-password"
                                       style="border-left: none; border-color: #ddd; border-radius: 0 10px 10px 0;">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Botón de submit -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-lg py-3 fw-bold text-white"
                                    style="background: #97866A; 
                                           border: none;
                                           border-radius: 10px;
                                           box-shadow: 0 4px 15px rgba(146, 72, 50, 0.514);
                                           transition: all 0.3s ease;">
                                <i class="fas fa-sign-in-alt me-2"></i> Iniciar Sesión
                            </button>
                        </div>
                                 
                        <!-- Registro -->
                        <div class="text-center pt-3" style="border-top: 1px solid #a35151;">
                            <p class="mb-2" style="color: #6c757d;">¿No tienes una cuenta?</p>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary px-4"
                               style="border-color: #a35151; 
                                      color: #a35151;
                                      border-radius: 10px;
                                      transition: all 0.3s ease;">
                                <i class="fas fa-user-plus me-2"></i> Crear cuenta
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    body {
        background-color: #081b2e;
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .form-control:focus {
        border-color: #ff6b6b !important;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.25) !important;
    }
    
    .btn-outline-primary:hover {
        background-color: #ff6b6b !important;
        color: white !important;
        border-color: #ff6b6b !important;
    }
    
    .input-group-text {
        border-radius: 10px 0 0 10px !important;
    }
</style>
@endsection