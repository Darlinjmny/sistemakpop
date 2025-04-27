@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
                <!-- Cabecera con gradiente -->
                <div class="card-header py-4" style="background:  #97866A;">
                    <div class="text-center">
                        <i class="fas fa-user-edit fa-3x text-white mb-3" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);"></i>
                        <h2 class="text-white mb-1" style="font-weight: 800;">Editar Integrante</h2>
                        <p class="text-white mb-0" style="opacity: 0.9;">Actualiza la información del integrante</p>
                    </div>
                </div>
                
                <!-- Cuerpo del formulario -->
                <div class="card-body p-5" style="background-color: #f8f9fa;">
                    <form action="{{ route('members.update', $member->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Campo Grupo -->
                        <div class="mb-4">
                            <label for="group_id" class="form-label" style="color: #495057; font-weight: 600;">Grupo</label>
                            <select class="form-control form-control-lg @error('group_id') is-invalid @enderror" 
                                    id="group_id" name="group_id" required>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ $member->group_id == $group->id ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('group_id')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Nombre -->
                        <div class="mb-4">
                            <label for="name" class="form-label" style="color: #495057; font-weight: 600;">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #fff; border-right: none;">
                                    <i class="fas fa-user" style="color: #97866A;"></i>
                                </span>
                                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $member->name) }}" required
                                       style="border-left: none; border-color: #ddd; border-radius: 0 10px 10px 0;">
                            </div>
                            @error('name')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Fecha de Nacimiento -->
                        <div class="mb-4">
                            <label for="birthdate" class="form-label" style="color: #495057; font-weight: 600;">Fecha de Nacimiento</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #fff; border-right: none;">
                                    <i class="fas fa-calendar-alt" style="color: #97866A;"></i>
                                </span>
                                <input type="date" class="form-control form-control-lg @error('birthdate') is-invalid @enderror" 
                                       id="birthdate" name="birthdate" value="{{ old('birthdate', $member->birthdate) }}" required
                                       style="border-left: none; border-color: #ddd; border-radius: 0 10px 10px 0;">
                            </div>
                            @error('birthdate')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Posición -->
                        <div class="mb-4">
                            <label for="position" class="form-label" style="color: #495057; font-weight: 600;">Posición</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: #fff; border-right: none;">
                                    <i class="fas fa-briefcase" style="color: #97866A;"></i>
                                </span>
                                <input type="text" class="form-control form-control-lg @error('position') is-invalid @enderror" 
                                       id="position" name="position" value="{{ old('position', $member->position) }}" required
                                       style="border-left: none; border-color: #ddd; border-radius: 0 10px 10px 0;">
                            </div>
                            @error('position')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-lg py-3 fw-bold text-white"
                                    style="background: #97866A; 
                                           border: none;
                                           border-radius: 10px;
                                           box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
                                           transition: all 0.3s ease;">
                                <i class="fas fa-save me-2"></i> Actualizar
                            </button>
                            <a href="{{ route('members.index') }}" class="btn btn-lg py-3 fw-bold text-white"
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