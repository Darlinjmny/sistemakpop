<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class SongController extends Controller
{
    // Mostrar todas las canciones
    public function index()
    {
        $songs = Song::with('album')->get();
        return view('songs.index', compact('songs'));
    }

    // Mostrar el formulario para crear una nueva canción
    public function create()
    {
        $albums = Album::all();
        return view('songs.create', compact('albums'));
    }

    public function pdf(){
        $songs = Song::with('album.group')->get();
        $pdf = PDF::loadView('songs.pdf', compact('songs'));
        return $pdf->stream();
    }

    // Guardar una nueva canción en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'title' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
        ]);

        Song::create($request->all());
        return redirect()->route('songs.index')->with('success', 'Canción creada exitosamente.');
    }

    // Mostrar los detalles de una canción específica
    public function show(Song $song)
    {
        return view('songs.show', compact('song'));
    }

    // Mostrar el formulario para editar una canción
    public function edit(Song $song)
    {
        $albums = Album::all();
        return view('songs.edit', compact('song', 'albums'));
    }

    // Actualizar una canción en la base de datos
    public function update(Request $request, Song $song)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'title' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
        ]);

        $song->update($request->all());
        return redirect()->route('songs.index')->with('success', 'Canción actualizada exitosamente.');
    }

    // Eliminar una canción de la base de datos
    public function destroy(Song $song)
    {
        $song->delete();
        return redirect()->route('songs.index')->with('success', 'Canción eliminada exitosamente.');
    }

 
    public function statistics()
   { 
    // 1. Calcular el total de canciones registradas
    $totalSongs = Song::count();

    // 2. Obtener álbumes con el conteo de canciones
    $albums = Album::withCount('songs')
                ->orderBy('songs_count', 'desc')
                ->get();

    // 3. Preparar datos para el gráfico
    $albumNames = $albums->pluck('title');
    $songCounts = $albums->pluck('songs_count');

    return view('songs.statistics', [
        'totalSongs' => $totalSongs,
        'albums' => $albumNames,  // Nombres de álbumes para el gráfico
        'counts' => $songCounts,   // Conteos para el gráfico
        'albumsData' => $albums    // Datos completos para la tabla
    ]);
}


public function exportToCSV()
    {
        // 1. Obtener canciones con relaciones necesarias
        $songs = Song::with(['album.group'])->get();
        
        // 2. Definir nombre del archivo
        $filename = "canciones_kpop_" . now()->format('Y-m-d') . ".csv";
        
        // 3. Configurar cabeceras HTTP
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
    
        // 4. Crear el contenido CSV
        $callback = function() use ($songs) {
            $file = fopen('php://output', 'w');
            
            // Añadir BOM para UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // Escribir encabezados
            fputcsv($file, [
                'Canción',
                'Duración de Canción',
                'Álbum',
                'Grupo',

            ]);
            
            // Escribir datos
            foreach ($songs as $song) {
                fputcsv($file, [
                    $song->title,
                    $this->formatDuration($song->duration),
                    $song->album->title,
                    $song->album->group->name,
                ]);
            }
            
            fclose($file);
        };
    
        // 5. Devolver respuesta
        return Response::stream($callback, 200, $headers);
    }

    // Función auxiliar para formatear duración (segundos a mm:ss)
    private function formatDuration($seconds)
    {
        return $seconds ? gmdate('i:s', $seconds) : 'N/A';
    }
}

