<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Models\Paciente;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::orderBy('apellidos')
            ->orderBy('nombres')
            ->paginate(10);

        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(StorePacienteRequest $request)
    {
        $paciente = Paciente::create($request->validated());

        return redirect()
            ->route('pacientes.show', $paciente)
            ->with('ok', 'Paciente registrado correctamente.');
    }

    public function show(Paciente $paciente)
    {
        $paciente->load(['citas.personal', 'atenciones.personal']);

        return view('pacientes.show', compact('paciente'));
    }

    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        $paciente->update($request->validated());

        return redirect()
            ->route('pacientes.show', $paciente)
            ->with('ok', 'Datos del paciente actualizados.');
    }

    public function destroy(Paciente $paciente)
    {
        if ($paciente->citas()->exists() || $paciente->atenciones()->exists()) {
            return back()->with('error', 'No se puede eliminar este paciente porque tiene citas o atenciones registradas.');
        }

        $paciente->delete();

        return redirect()
            ->route('pacientes.index')
            ->with('ok', 'Paciente eliminado correctamente.');
    }
}