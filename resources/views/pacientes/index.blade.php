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

    @if(session('error'))
        <article style="border-left: 4px solid #c62828; padding: 0.75rem 1rem;">
            {{ session('error') }}
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
                    <td style="display: flex; gap: 0.5rem; align-items: center;">
                        <a href="{{ route('pacientes.show', $paciente) }}">Ver</a>
                        <span>·</span>
                        <a href="{{ route('pacientes.edit', $paciente) }}">Editar</a>
                        <span>·</span>
                        <form method="POST" action="{{ route('pacientes.destroy', $paciente) }}" style="margin: 0;" onsubmit="return confirm('¿Seguro que deseas eliminar a este paciente?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="outline secondary" style="padding: 0.2rem 0.6rem; font-size: 0.85rem; margin: 0;">Eliminar</button>
                        </form>
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