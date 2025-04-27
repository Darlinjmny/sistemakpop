<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Group;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class AlbumController extends Controller
{
    // Mostrar todos los álbumes
    public function index()
    {
        $albums = Album::with('group')->get();
        return view('albums.index', compact('albums'));
    }

    // Mostrar el formulario para crear un nuevo álbum
    public function create()
    {
        $groups = Group::all();
        return view('albums.create', compact('groups'));
    }

    public function pdf(){
        $albums = Album::all();
        $pdf = PDF::loadView('albums.pdf', compact('albums'));
        return $pdf->stream();
    }

    // Guardar un nuevo álbum en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
        ]);

        Album::create($request->all());
        return redirect()->route('albums.index')->with('success', 'Álbum creado exitosamente.');
    }

    // Mostrar los detalles de un álbum específico
    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

    // Mostrar el formulario para editar un álbum
    public function edit(Album $album)
    {
        $groups = Group::all();
        return view('albums.edit', compact('album', 'groups'));
    }

    // Actualizar un álbum en la base de datos
    public function update(Request $request, Album $album)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
        ]);

        $album->update($request->all());
        return redirect()->route('albums.index')->with('success', 'Álbum actualizado exitosamente.');
    }

    // Eliminar un álbum de la base de datos
    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('albums.index')->with('success', 'Álbum eliminado exitosamente.');
    }

    public function statistics()
    {
        // Obtener los nombres de los grupos y el conteo de álbumes
        $groups = Group::withCount('albums')->get();
        $totalAlbums = Album::count();

        $groupNames = $groups->pluck('name'); // Nombres de los grupos
        $albumCounts = $groups->pluck('albums_count'); // Conteo de álbumes por grupo

        // Retornar la vista con los datos
        return view('albums.statistics', [
            'groupNames' => $groupNames,
            'albumCounts' => $albumCounts,
            'totalAlbums' => $totalAlbums,
        ]);
    }


        public function exportToCSV()
        {
            // 1. Obtener álbumes con sus grupos relacionados
            $albums = Album::with('group')->get();
            
            // 2. Definir nombre del archivo
            $filename = "albumes_kpop_" . now()->format('Y-m-d') . ".csv";
            
            // 3. Configurar cabeceras HTTP
            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ];
        
            // 4. Crear el contenido CSV
            $callback = function() use ($albums) {
                $file = fopen('php://output', 'w');
                
                // Añadir BOM para UTF-8
                fwrite($file, "\xEF\xBB\xBF");
                
                // Escribir encabezados
                fputcsv($file, [
                    'Título del Álbum',
                    'Fecha de Lanzamiento',
                    'Grupo',
                ]);
                
                // Escribir datos
                foreach ($albums as $album) {
                    fputcsv($file, [
                        $album->title,
                        $album->release_date ? Carbon::parse($album->release_date)->format('d/m/Y') : 'N/A',
                        $album->group->name ?? 'Sin grupo',
                    ]);
                }
                
                fclose($file);
            };
        
            // 5. Devolver respuesta
            return Response::stream($callback, 200, $headers);
        }
    
    }