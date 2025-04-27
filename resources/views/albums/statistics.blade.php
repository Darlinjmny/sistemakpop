{{-- filepath: c:\xampp\htdocs\proyecto-laravel\prueba2\resources\views\albums\statistics.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Estadísticas de Álbumes por Grupo</h1>

    <!-- Mostrar el total de álbumes -->
    <div class="alert" role="alert" style="border-radius: 20px; background-color: rgba(182, 152, 152, 0.2); color: rgb(92, 48, 48);">
        <strong>Total de Álbumes Registrados:</strong> {{ $totalAlbums }}
    </div>

    <!-- Gráfico de álbumes por grupo -->
    <div class="card">
        <div class="card-body">
            <h3>Álbumes por Grupo</h3>
            <canvas id="albumsChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const groupNames = @json($groupNames);
    const albumCounts = @json($albumCounts);

    const ctx = document.getElementById('albumsChart').getContext('2d');
    const albumsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: groupNames,
            datasets: [{
                label: 'Número de Álbumes',
                data: albumCounts,
                backgroundColor: 'rgba(165, 42, 42, 0.5)', // Marrón claro
                borderColor: 'rgba(165, 42, 42, 1)', // Marrón oscuro
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection