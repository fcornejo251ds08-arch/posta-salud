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
        //
    }

    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        //
    }

    public function destroy(Paciente $paciente)
    {
        //
    }
}