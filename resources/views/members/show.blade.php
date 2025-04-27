@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
                <!-- Cabecera con gradiente -->
                <div class="card-header py-4" style="background: #97866A;">
                    <div class="text-center">
                        <i class="fas fa-user fa-3x text-white mb-3" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);"></i>
                        <h2 class="text-white mb-1" style="font-weight: 800;">Detalles del Miembro</h2>
                        <p class="text-white mb-0" style="opacity: 0.9;">Información detallada del miembro</p>
                    </div>
                </div>
                
                <!-- Cuerpo con información -->
                <div class="card-body p-5" style="background-color: #f8f9fa;">
                    <h1 class="text-center mb-4" style="font-weight: 700; color: #495057;">{{ $member->name }}</h1>
                    <p class="fs-5"><strong>Grupo:</strong> {{ $member->group->name }}</p>
                    <p class="fs-5"><strong>Fecha de Nacimiento:</strong> {{ $member->birthdate }}</p>
                    <p class="fs-5"><strong>Posición:</strong> {{ $member->position }}</p>
                    <!-- Botón de volver -->
                    <div class="d-grid mt-4">
                        <a href="{{ route('members.index') }}" class="btn btn-lg py-3 fw-bold text-white"
                           style="background:  linear-gradient(to right, #97866A, #330000); ; 
                                  border: none;
                                  border-radius: 10px;
                                  box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
                                  transition: all 0.3s ease;">
                            <i class="fas fa-arrow-left me-2"></i> Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    body {
        background-color: #f1f3f5;
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
</style>
@endsection