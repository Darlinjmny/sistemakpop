<!-- filepath: c:\xampp\htdocs\proyecto-laravel\prueba2\resources\views\groups\statistics.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Estadísticas de Grupos</h1>

    <!-- Mostrar el total de grupos -->
    <div class="alert" role="alert" style="border-radius: 20px; background-color: rgba(182, 152, 152, 0.2); color: rgb(92, 48, 48);">
        <strong>Total de Grupos Registrados:</strong> {{ $totalGroups }}
    </div>

    <!-- Gráfico de grupos por compañía -->
    <div class="card mb-4">
        <div class="card-body">
            <h3>Grupos por Compañía</h3>
            <canvas id="groupsByCompanyChart" width="200" height="100"></canvas> <!-- Tamaño reducido -->
        </div>
    </div>
</div>

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Obtener datos desde el backend
    const companies = @json($companies);
    const counts = @json($counts);

    // Configurar el gráfico
    const ctx = document.getElementById('groupsByCompanyChart').getContext('2d');
    const groupsByCompanyChart = new Chart(ctx, {
        type: 'bar', // Tipo de gráfico (puede ser 'bar', 'line', 'pie', etc.)
        data: {
            labels: companies, // Etiquetas (nombres de las compañías)
            datasets: [{
                label: 'Cantidad de Grupos',
                data: counts, // Datos (cantidad de grupos por compañía)
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