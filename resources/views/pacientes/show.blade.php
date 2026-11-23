@extends('layouts.app')

@section('titulo', 'Detalle del paciente')

@section('contenido')
    <header style="display: flex; justify-content: space-between; align-items: center;">
        <h1>{{ $paciente->apellidos }}, {{ $paciente->nombres }}</h1>
        <div>
            <a href="{{ route('pacientes.edit', $paciente) }}" role="button">Editar</a>
            <a href="{{ route('pacientes.index') }}" role="button" class="secondary">Volver</a>
        </div>
    </header>

    <article>
        <p><strong>DNI:</strong> {{ $paciente->dni }}</p>
        <p><strong>Fecha de nacimiento:</strong> {{ $paciente->fecha_nacimiento }}</p>
        <p><strong>Sexo:</strong> {{ $paciente->sexo }}</p>
        <p><strong>Teléfono:</strong> {{ $paciente->telefono ?? 'No registrado' }}</p>
        <p><strong>Dirección:</strong> {{ $paciente->direccion ?? 'No registrada' }}</p>
    </article>

    <h3>Citas registradas ({{ $paciente->citas->count() }})</h3>
    @if($paciente->citas->isEmpty())
        <p>Este paciente no tiene citas registradas.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Fecha y hora</th>
                    <th>Personal médico</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paciente->citas as $cita)
                    <tr>
                        <td>{{ $cita->fecha_hora }}</td>
                        <td>{{ $cita->personal->apellidos ?? '—' }}, {{ $cita->personal->nombres ?? '' }}</td>
                        <td>{{ $cita->motivo }}</td>
                        <td>{{ $cita->estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h3>Atenciones médicas ({{ $paciente->atenciones->count() }})</h3>
    @if($paciente->atenciones->isEmpty())
        <p>Este paciente no tiene atenciones registradas.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Personal médico</th>
                    <th>Diagnóstico</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paciente->atenciones as $atencion)
                    <tr>
                        <td>{{ $atencion->fecha_atencion }}</td>
                        <td>{{ $atencion->personal->apellidos ?? '—' }}, {{ $atencion->personal->nombres ?? '' }}</td>
                        <td>{{ $atencion->diagnostico }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection