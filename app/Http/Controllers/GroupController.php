<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;


class GroupController extends Controller
{
    // Mostrar todos los grupos
    public function index()
    {
        $groups = Group::all();
        return view('groups.index', compact('groups'));
    }

    public function pdf()
    {
        $groups = Group::all();
        $pdf = Pdf::loadView('groups.pdf', compact('groups'));
        return $pdf->stream();
    }
    

    // Mostrar los detalles de un grupo específico
    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }

    // Mostrar el formulario para crear un nuevo grupo
    public function create()
    {
        return view('groups.create');
    }

    // Guardar un nuevo grupo en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'debut_date' => 'required|date',
            'company' => 'required|string|max:255',
        ]);

        Group::create($request->all());
        return redirect()->route('groups.index')->with('success', 'Grupo creado exitosamente.');
    }

    // Mostrar el formulario para editar un grupo
    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
    }

    // Actualizar un grupo en la base de datos
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'debut_date' => 'required|date',
            'company' => 'required|string|max:255',
        ]);

        $group->update($request->all());
        return redirect()->route('groups.index')->with('success', 'Grupo actualizado exitosamente.');
    }

    // Eliminar un grupo de la base de datos
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('groups.index')->with('success', 'Grupo eliminado exitosamente.');
    }

    public function exportToCSV()
    {
        // 1. Obtener grupos con conteo de álbumes y miembros
        $groups = Group::withCount(['albums', 'members'])->get();
        
        // 2. Definir nombre del archivo
        $filename = "grupos_kpop_" . now()->format('Y-m-d') . ".csv";
        
        // 3. Configurar cabeceras HTTP
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
    
        // 4. Crear el contenido CSV
        $callback = function() use ($groups) {
            $file = fopen('php://output', 'w');
            
            // Añadir BOM para UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // Escribir encabezados
            fputcsv($file, [
                'Nombre del Grupo',
                'Fecha de Debut',
                'Compañía',
                
            ]);
            
            // Escribir datos
            foreach ($groups as $group) {
        
                fputcsv($file, [
                    $group->name,
                    $group->debut_date ? Carbon::parse($group->debut_date)->format('d/m/Y') : 'N/A',
                    $group->company,
                ]);
            }
            
            fclose($file);
        };
    
        // 5. Devolver respuesta
        return Response::stream($callback, 200, $headers);
    }
}

