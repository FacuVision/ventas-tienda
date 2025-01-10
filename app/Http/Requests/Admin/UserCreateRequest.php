<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required",
            "lastname" => "required",
            'email' => 'required|email:rfc,dns|unique:users,email', // Especifica la tabla y la columna
            'phone' => 'required|unique:users,phone', // Especifica la tabla y la columna
            'address' => 'required', // Especifica la tabla y la columna
            'document_type' => 'required',
            'n_document' => 'required|unique:users,n_document', // Especifica la tabla y la columna
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "El nombre es obligatorio.",
            "lastname.required" => "El apellido es obligatorio.",
            'email.required' => 'El correo es obligatorio.',
            'phone.required' => 'El telefono es obligatorio.',
            'address.required' => 'La direccion es obligatoria.',
            'email.unique' => 'Este correo ya ha sido registrado para otro usuario.',
            'email.email' => 'El formato del correo no es válido (example@gmail.com).',
            'document_type.required' => 'El tipo de documento es obligatorio.',
            'n_document.required' => 'El número de documento es obligatorio.',
            'n_document.unique' => 'Este número de documento ya ha sido registrado.',
        ];
    }
}
