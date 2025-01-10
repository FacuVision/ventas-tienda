<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $id = $this->route('user'); // Obtén el ID del registro actual desde la ruta

        return [
            "name_edit" => "required",
            "lastname_edit" => "required",
            'email_edit' => 'required|email:rfc,dns|unique:users,email,'.$id, // Especifica la tabla y la columna
            'phone_edit' => 'required|unique:users,phone,'.$id, // Especifica la tabla y la columna
            'address_edit' => 'required', // Especifica la tabla y la columna
            'document_type_edit' => 'required',
            'n_document_edit' => 'required|unique:users,n_document,'.$id, // Especifica la tabla y la columna
        ];

    }

    public function messages(): array
    {
        return [
            "name_edit.required" => "El nombre es obligatorio.",
            "lastname_edit.required" => "El apellido es obligatorio.",
            'email_edit.required' => 'El correo es obligatorio.',
            'phone_edit.required' => 'El telefono es obligatorio.',
            'address.required' => 'La direccion es obligatoria.',
            'email_edit.unique' => 'Este correo ya ha sido registrado para otro usuario.',
            'email_edit.email' => 'El formato del correo no es válido (example@gmail.com).',
            'document_type_edit.required' => 'El tipo de documento es obligatorio.',
            'n_document_edit.required' => 'El número de documento es obligatorio.',
            'n_document_edit.unique' => 'Este número de documento ya ha sido registrado.',
        ];
    }
}
