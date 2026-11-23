@extends('layouts.app')

@section('titulo', 'Editar paciente')

@section('contenido')
    <header style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Editar paciente</h1>
        <a href="{{ route('pacientes.show', $paciente) }}" role="button" class="secondary">Volver</a>
    </header>

    @if($errors->any())
        <article style="border-left: 4px solid #c62828; padding: 0.75rem 1rem;">
            <strong>Corrige los siguientes errores:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </article>
    @endif

    <form method="POST" action="{{ route('pacientes.update', $paciente) }}">
        @csrf
        @method('PUT')

        <label>
            DNI *
            <input type="text" name="dni" value="{{ old('dni', $paciente->dni) }}" maxlength="8" required>
        </label>

        <div class="grid">
            <label>
                Nombres *
                <input type="text" name="nombres" value="{{ old('nombres', $paciente->nombres) }}" maxlength="100" required>
            </label>
            <label>
                Apellidos *
                <input type="text" name="apellidos" value="{{ old('apellidos', $paciente->apellidos) }}" maxlength="100" required>
            </label>
        </div>

        <div class="grid">
            <label>
                Fecha de nacimiento *
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" required>
            </label>
            <label>
                Sexo *
                <select name="sexo" required>
                    <option value="">Selecciona...</option>
                    <option value="M" @selected(old('sexo', $paciente->sexo) === 'M')>Masculino</option>
                    <option value="F" @selected(old('sexo', $paciente->sexo) === 'F')>Femenino</option>
                </select>
            </label>
        </div>

        <label>
            Teléfono
            <input type="text" name="telefono" value="{{ old('telefono', $paciente->telefono) }}" maxlength="20">
        </label>

        <label>
            Dirección
            <input type="text" name="direccion" value="{{ old('direccion', $paciente->direccion) }}" maxlength="200">
        </label>

        <button type="submit">Actualizar paciente</button>
    </form>
@endsection