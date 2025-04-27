@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
                <!-- Cabecera con gradiente -->
                <div class="card-header py-4" style="background: #97866A;">
                    <div class="text-center">
                        <i class="fas fa-compact-disc fa-3x text-white mb-3" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);"></i>
                        <h2 class="text-white mb-1" style="font-weight: 800;">Crear Álbum</h2>
                        <p class="text-white mb-0" style="opacity: 0.9;">Agrega un nuevo álbum de K-pop</p>
                    </div>
                </div>
                
                <!-- Cuerpo del formulario -->
                <div class="card-body p-5" style="background-color: #f8f9fa;">
                    <form action="{{ route('albums.store') }}" method="POST">
                        @csrf

                        <!-- Campo Grupo -->
                        <div class="mb-4">
                            <label for="group_id" class="form-label" style="color: #495057; font-weight: 600;">Grupo</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #fff; border-right: none;">
                                    <i class="fas fa-users" style="color: #97866A;"></i>
                                </span>
                                <select class="form-control form-control-lg @error('group_id') is-invalid @enderror" 
                                        id="group_id" name="group_id" required
                                        style="border-left: none; border-color: #ddd; border-radius: 0 10px 10px 0;">
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('group_id')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Título -->
                        <div class="mb-4">
                            <label for="title" class="form-label" style="color: #495057; font-weight: 600;">Título del Álbum</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #fff; border-right: none;">
                                    <i class="fas fa-heading" style="color: #97866A;"></i>
                                </span>
                                <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                       id="title" name="title" required
                                       style="border-left: none; border-color: #ddd; border-radius: 0 10px 10px 0;">
                            </div>
                            @error('title')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Fecha de Lanzamiento -->
                        <div class="mb-4">
                            <label for="release_date" class="form-label" style="color: #495057; font-weight: 600;">Fecha de Lanzamiento</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #fff; border-right: none;">
                                    <i class="fas fa-calendar-alt" style="color: #97866A;"></i>
                                </span>
                                <input type="date" class="form-control form-control-lg @error('release_date') is-invalid @enderror" 
                                       id="release_date" name="release_date" required
                                       style="border-left: none; border-color: #ddd; border-radius: 0 10px 10px 0;">
                            </div>
                            @error('release_date')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botón de Guardar -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-lg py-3 fw-bold text-white"
                                    style="background: #97866A; 
                                           border: none;
                                           border-radius: 10px;
                                           box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
                                           transition: all 0.3s ease;">
                                <i class="fas fa-save me-2"></i> Guardar
                            </button>
                            <a href="{{ route('albums.index') }}" class="btn btn-lg py-3 fw-bold text-white"
                               style="background: linear-gradient(to right, #97866A, #330000); 
                                      border: none;
                                      border-radius: 10px;
                                      box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
                                      transition: all 0.3s ease;">
                                <i class="fas fa-times me-2"></i> Cancelar
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
        background-color: #f1f3f5;
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .form-control:focus {
        border-color: #6c757d !important;
        box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25) !important;
    }
</style>
@endsection