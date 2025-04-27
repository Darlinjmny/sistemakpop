<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-pop dtb</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome (opcional, para íconos) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Canciones</h1>
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('songs.create') }}" class="btn btn-primary btn-lg" style="border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <i class="fas fa-plus-circle"></i> Crear Canción
            </a>
         <div>
            <a href="{{ route('songs.pdf') }}" class="btn btn-danger btn-lg" style="border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <i class="fas fa-file-pdf"></i> Imprimir PDF
            </a>
            <a href="{{ route('songs.export.csv') }}" class="btn btn-success btn-lg" style="border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <i class="fas fa-file-excel"></i> Exportar 
            </a>
            <a href="{{ route('songs.statistics') }}" class="btn btn-secondary btn-lg" style="border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <i class="fas fa-chart-bar"></i> Ver Estadísticas
            </a>
        </div>
    </div>

        <table id="songs-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Título de la canción</th>
                    <th>Duración de la canción</th>
                    <th>Álbum</th>
                    <th>Grupo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($songs as $song)
                    <tr id="song-{{ $song->id }}">
                        <td>{{ $song->title }}</td>
                        <td>{{ gmdate('i:s', $song->duration) }}</td>
                        <td>{{ $song->album->title }}</td>
                        <td>{{ $song->album->group->name }}</td>
                        <td>
                            <a href="{{ route('songs.edit', $song->id) }}" class="btn btn-warning btn-sm" style="border-radius: 20px;">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="{{ route('songs.show', $song->id) }}" class="btn btn-info btn-sm" style="border-radius: 20px;">
                                <i class="fas fa-eye"></i> Ver Detalles
                            </a>
                            <form action="{{ route('songs.destroy', $song->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 20px;" onclick="return confirm('¿Estás seguro de eliminar esta canción?')">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#songs-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' // Español
                },
                responsive: true,
                order: [[0, 'asc']], // Ordenar por la primera columna (Título)
                dom: 'Bfrtip', // Posición de los botones
                buttons: [
                    {
                        extend: 'pdfHtml5', // Botón para exportar a PDF
                        text: '<i class="fas fa-file-pdf"></i> PDF', // Texto e ícono del botón
                        className: 'btn btn-danger btn-sm', // Clases de Bootstrap
                        exportOptions: {
                            columns: [0, 1, 2, 3] // Columnas a exportar (0: Título, 1: Duración, 2: Álbum, 3: Grupo)
                        }
                    },
                    {
                        extend: 'excelHtml5', // Botón para exportar a Excel
                        text: '<i class="fas fa-file-excel"></i> Excel', // Texto e ícono del botón
                        className: 'btn btn-success btn-sm', // Clases de Bootstrap
                        exportOptions: {
                            columns: [0, 1, 2, 3] // Columnas a exportar (0: Título, 1: Duración, 2: Álbum, 3: Grupo)
                        }
                    }
                ]
            });
        });
    </script>
@endsection