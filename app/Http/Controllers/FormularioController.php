<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario; // Asegúrate de importar tu modelo

class FormularioController extends Controller
{
    // Muestra la vista del formulario
    public function create()
    {
        return view('solicitud');
    }

    // Procesa los datos y los guarda en la base de datos
    public function store(Request $request)
    {
        // Validar los campos enviados por el formulario HTML
        $request->validate([
            'nom_lugar' => 'required|string|max:255',
            'dir_lugar' => 'required|string|max:255',
            'actividad' => 'required|string|max:255',
            'carrera'   => 'required|string|max:255',
            'materia'   => 'required|string|max:255',
        ]);

        // Guardar en la base de datos usando el modelo Formulario
        formulario::create([
            'nom_lugar' => $request->nom_lugar,
            'dir_lugar' => $request->dir_lugar,
            'actividad' => $request->actividad,
            'carrera'   => $request->carrera,
            'materia'   => $request->materia,
        ]);

        return redirect()->back()->with('success', '¡Solicitud de seguro enviada con éxito!');
    }
}
