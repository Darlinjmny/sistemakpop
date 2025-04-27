<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Group;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class MemberController extends Controller
{
    // Mostrar todos los integrantes
    public function index()
    {
        $members = Member::with('group')->get();
        return view('members.index', compact('members'));
    }

    // Mostrar el formulario para crear un nuevo integrante
    public function create()
    {
        $groups = Group::all();
        return view('members.create', compact('groups'));
    }

    public function pdf(){
        $members = Member::all();
        $pdf = PDF::loadView('members.pdf', compact('members'));    
        return $pdf->stream();
    }

    // Guardar un nuevo integrante en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'position' => 'required|string|max:255',
        ]);

        Member::create($request->all());
        return redirect()->route('members.index')->with('success', 'Integrante creado exitosamente.');
    }

    // Mostrar los detalles de un integrante específico
    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    // Mostrar el formulario para editar un integrante
    public function edit(Member $member)
    {
        $groups = Group::all();
        return view('members.edit', compact('member', 'groups'));
    }

    // Actualizar un integrante en la base de datos
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'position' => 'required|string|max:255',
        ]);

        $member->update($request->all());
        return redirect()->route('members.index')->with('success', 'Integrante actualizado exitosamente.');
    }

    // Eliminar un integrante de la base de datos
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Integrante eliminado exitosamente.');
    }

    public function statistics()
    {
        // Obtener los nombres de los grupos y el conteo de miembros
        $groups = Group::withCount('members')->get();
        $totalMembers = Member::count();

        $groupNames = $groups->pluck('name'); // Nombres de los grupos
        $memberCounts = $groups->pluck('members_count'); // Conteo de miembros por grupo

        // Retornar la vista con los datos
        return view('members.statistics', [
            'groupNames' => $groupNames,
            'memberCounts' => $memberCounts,
            'totalMembers' => $totalMembers,
        ]);
    }

   

        public function exportToCSV()
        {
            // 1. Obtener miembros con sus grupos
            $members = Member::with('group')->get();
            
            // 2. Nombre del archivo
            $filename = "integrantes_kpop_".now()->format('Y-m-d').".csv";
            
            // 3. Configurar cabeceras
            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
                "Pragma" => "no-cache"
            ];
    
            // 4. Generar contenido CSV
            return Response::stream(function() use ($members) {
                $file = fopen('php://output', 'w');
                fwrite($file, "\xEF\xBB\xBF"); // BOM UTF-8
                
                // Encabezados
                fputcsv($file, [
                    'Nombre',
                    'Fecha de Nacimiento',
                    'Posición',
                    'Grupo',
            
                ]);
                
                // Datos
                foreach ($members as $member) {
                    fputcsv($file, [
                        $member->name,
                        $member->birthdate ? Carbon::parse($member->birthdate)->format('d/m/Y') : '',
                        $member->position,
                        $member->group->name,
                    ]);
                }
                fclose($file);
            }, 200, $headers);
        }
}
