<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dni'              => ['required', 'digits:8', 'unique:pacientes,dni'],
            'nombres'          => ['required', 'string', 'max:100'],
            'apellidos'        => ['required', 'string', 'max:100'],
            'fecha_nacimiento' => ['required', 'date', 'before:today'],
            'sexo'             => ['required', 'in:M,F'],
            'telefono'         => ['nullable', 'string', 'max:20'],
            'direccion'        => ['nullable', 'string', 'max:200'],
        ];
    }

    public function messages(): array
    {
        return [
            'dni.required'              => 'El DNI es obligatorio.',
            'dni.digits'                => 'El DNI debe tener exactamente 8 dígitos numéricos.',
            'dni.unique'                => 'Ya existe un paciente registrado con ese DNI.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'sexo.in'                   => 'Selecciona Masculino o Femenino.',
        ];
    }
}