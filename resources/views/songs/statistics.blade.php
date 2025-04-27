@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Estadísticas de Canciones por Álbum</h1>

    <!-- Mostrar el total de canciones registradas -->
    <div class="alert" role="alert" style="border-radius: 20px; background-color: rgba(182, 152, 152, 0.2); color: rgb(92, 48, 48);">
        <strong>Total de Canciones Registradas:</strong> {{ $totalSongs }}
    </div>

    <!-- Gráfico de canciones por álbum -->
    <div class="card mt-4">
        <div class="card-body">
            <h3>Canciones por Álbum</h3>
            <canvas id="songsChart" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- Tabla detallada -->
    <div class="card mt-4">
        <div class="card-body">
            <h3>Detalle del Álbum</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Álbum</th>
                        <th>Canciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($albumsData as $album)
                    <tr>
                        <td>{{ $album->title }}</td>
                        <td>{{ $album->songs_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const albumNames = @json($albums);
    const songCounts = @json($counts);

    const ctx = document.getElementById('songsChart').getContext('2d');
    const songsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: albumNames,
            datasets: [{
                label: 'Número de Canciones',
                data: songCounts,
                backgroundColor: 'rgba(165, 42, 42, 0.5)', // Marrón claro
                borderColor: 'rgba(165, 42, 42, 1)', // Marrón oscuro
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endsection