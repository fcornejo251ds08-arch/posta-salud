<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePacienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dni'              => [
                'required',
                'digits:8',
                Rule::unique('pacientes', 'dni')->ignore($this->route('paciente')),
            ],
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
            'dni.unique'                => 'Ya existe otro paciente registrado con ese DNI.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'sexo.in'                   => 'Selecciona Masculino o Femenino.',
        ];
    }
}