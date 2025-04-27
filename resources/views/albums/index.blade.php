@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Álbumes</h1>
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('albums.create') }}" class="btn btn-primary btn-lg" style="border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <i class="fas fa-plus-circle"></i> Crear Álbum
            </a>
            <div>
                <a href="{{ route('albums.pdf') }}" class="btn btn-danger btn-lg me-2" style="border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <i class="fas fa-file-pdf"></i> Imprimir PDF
                </a>    
                <a href="{{ route('albums.export.csv') }}" class="btn btn-success btn-lg" style="border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <i class="fas fa-file-excel"></i> Exportar
                </a>
                <a href="{{ route('albums.statistics') }}" class="btn btn-secondary btn-lg" style="border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <i class="fas fa-chart-bar"></i> Ver Estadísticas
                </a>
            </div>
        </div>

        <table id="albums-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Título del Álbum</th>
                    <th>Fecha de Lanzamiento</th>
                    <th>Grupo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($albums as $album)
                    <tr id="album-{{ $album->id }}">
                        <td>{{ $album->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($album->release_date)->format('d/m/Y') }}</td>
                        <td>{{ $album->group->name }}</td>
                        <td>
                            <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-warning btn-sm" style="border-radius: 20px;">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="{{ route('albums.show', $album->id) }}" class="btn btn-info btn-sm" style="border-radius: 20px;">
                                <i class="fas fa-eye"></i> Ver Detalles
                            </a>
                            <form action="{{ route('albums.destroy', $album->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 20px;" onclick="return confirm('¿Estás seguro de eliminar este álbum?')">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection