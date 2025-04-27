@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
                <!-- Cabecera con gradiente -->
                <div class="card-header py-4" style="background: #97866A;">
                    <div class="text-center">
                        <i class="fas fa-music fa-3x text-white mb-3" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);"></i>
                        <h2 class="text-white mb-1" style="font-weight: 800;">Crear Canción</h2>
                        <p class="text-white mb-0" style="opacity: 0.9;">Agrega una nueva canción al álbum</p>
                    </div>
                </div>
                
                <!-- Cuerpo del formulario -->
                <div class="card-body p-5" style="background-color: #f8f9fa;">
                    <form action="{{ route('songs.store') }}" method="POST">
                        @csrf

                        <!-- Campo Álbum -->
                        <div class="mb-4">
                            <label for="album_id" class="form-label" style="color: #495057; font-weight: 600;">Álbum</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #fff; border-right: none;">
                                    <i class="fas fa-compact-disc" style="color: #97866A;"></i>
                                </span>
                                <select class="form-select form-select-lg @error('album_id') is-invalid @enderror" 
                                        id="album_id" name="album_id" required
                                        style="border-left: none; border-color: #ddd; border-radius: 0 10px 10px 0;">
                                    <option value="" disabled selected>Seleccione un álbum</option>
                                    @foreach($albums as $album)
                                        <option value="{{ $album->id }}">{{ $album->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('album_id')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Título -->
                        <div class="mb-4">
                            <label for="title" class="form-label" style="color: #495057; font-weight: 600;">Título</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #fff; border-right: none;">
                                    <i class="fas fa-heading" style="color: #97866A;"></i>
                                </span>
                                <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                       id="title" name="title" placeholder="Ingrese el título" required
                                       style="border-left: none; border-color: #ddd; border-radius: 0 10px 10px 0;">
                            </div>
                            @error('title')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Duración -->
                        <div class="mb-4">
                            <label for="duration" class="form-label" style="color: #495057; font-weight: 600;">Duración (segundos)</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #fff; border-right: none;">
                                    <i class="fas fa-clock" style="color: #97866A;"></i>
                                </span>
                                <input type="number" class="form-control form-control-lg @error('duration') is-invalid @enderror" 
                                       id="duration" name="duration" placeholder="Ingrese la duración" required
                                       style="border-left: none; border-color: #ddd; border-radius: 0 10px 10px 0;">
                            </div>
                            @error('duration')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-lg py-3 fw-bold text-white"
                                    style="background: #97866A; 
                                           border: none;
                                           border-radius: 10px;
                                           box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
                                           transition: all 0.3s ease;">
                                <i class="fas fa-save me-2"></i> Guardar
                            </button>
                            <a href="{{ route('songs.index') }}" class="btn btn-lg py-3 fw-bold text-white"
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