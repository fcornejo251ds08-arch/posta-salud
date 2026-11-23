@extends('layouts.app')

@section('titulo', 'Pacientes')

@section('contenido')
    <header style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Pacientes</h1>
        <a href="{{ route('pacientes.create') }}" role="button">+ Nuevo paciente</a>
    </header>

    @if(session('ok'))
        <article style="border-left: 4px solid var(--pico-primary); padding: 0.75rem 1rem;">
            {{ session('ok') }}
        </article>
    @endif

    <table>
        <thead>
            <tr>
                <th>DNI</th>
                <th>Apellidos y nombres</th>
                <th>Sexo</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pacientes as $paciente)
                <tr>
                    <td>{{ $paciente->dni }}</td>
                    <td>{{ $paciente->apellidos }}, {{ $paciente->nombres }}</td>
                    <td>{{ $paciente->sexo }}</td>
                    <td>{{ $paciente->telefono ?? '—' }}</td>
                    <td>
                        <a href="{{ route('pacientes.show', $paciente) }}">Ver</a> ·
                        <a href="{{ route('pacientes.edit', $paciente) }}">Editar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay pacientes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $pacientes->links() }}
@endsection