{{-- filepath: c:\xampp\htdocs\proyecto-laravel\prueba2\resources\views\members\statistics.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Estadísticas de Miembros por Grupo</h1>

    <!-- Mostrar el total de miembros -->
    <div class="alert" role="alert" style="border-radius: 20px; background-color: rgba(182, 152, 152, 0.2); color: rgb(92, 48, 48);">
        <strong>Total de Miembros Registrados:</strong> {{ $totalMembers }}
    </div>

    <!-- Gráfico de miembros por grupo -->
    <div class="card mb-4">
        <div class="card-body">
            <h3>Miembros por Grupo</h3>
            <canvas id="membersChart" width="200" height="100"></canvas> <!-- Tamaño reducido -->
        </div>
    </div>
</div>

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Obtener datos desde el backend
    const groupNames = @json($groupNames);
    const memberCounts = @json($memberCounts);

    // Configurar el gráfico
    const ctx = document.getElementById('membersChart').getContext('2d');
    const membersChart = new Chart(ctx, {
        type: 'bar', // Tipo de gráfico (puede ser 'bar', 'line', 'pie', etc.)
        data: {
            labels: groupNames, // Etiquetas (nombres de los grupos)
            datasets: [{
                label: 'Número de Miembros',
                data: memberCounts, // Datos (cantidad de miembros por grupo)
                backgroundColor: 'rgba(165, 42, 42, 0.5)', // Marrón claro
                borderColor: 'rgba(165, 42, 42, 1)', // Marrón oscuro
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true // Comenzar el eje Y desde 0
                }
            }
        }
    });
</script>
@endsection