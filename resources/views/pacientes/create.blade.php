@extends('layouts.app')

@section('titulo', 'Nuevo paciente')

@section('contenido')
    <header style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Nuevo paciente</h1>
        <a href="{{ route('pacientes.index') }}" role="button" class="secondary">Volver</a>
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

    <form method="POST" action="{{ route('pacientes.store') }}">
        @csrf

        <label>
            DNI *
            <input type="text" name="dni" value="{{ old('dni') }}" maxlength="8" required>
        </label>

        <div class="grid">
            <label>
                Nombres *
                <input type="text" name="nombres" value="{{ old('nombres') }}" maxlength="100" required>
            </label>
            <label>
                Apellidos *
                <input type="text" name="apellidos" value="{{ old('apellidos') }}" maxlength="100" required>
            </label>
        </div>

        <div class="grid">
            <label>
                Fecha de nacimiento *
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
            </label>
            <label>
                Sexo *
                <select name="sexo" required>
                    <option value="">Selecciona...</option>
                    <option value="M" @selected(old('sexo') === 'M')>Masculino</option>
                    <option value="F" @selected(old('sexo') === 'F')>Femenino</option>
                </select>
            </label>
        </div>

        <label>
            Teléfono
            <input type="text" name="telefono" value="{{ old('telefono') }}" maxlength="20">
        </label>

        <label>
            Dirección
            <input type="text" name="direccion" value="{{ old('direccion') }}" maxlength="200">
        </label>

        <button type="submit">Guardar paciente</button>
    </form>
@endsection