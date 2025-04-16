<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class JobUpdateRequest extends FormRequest
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
            "job" => "required",
            "id" => "required",
            "date" => "required",
            "status" => "required",
            "pay_status" => "required",
            "observations" => "required"
        ];
    }

    public function messages(): array
    {
        return [
            "job.required" => "El trabajo es requerido",
            "id.required" => "El id trabajo es requerido",
            "date.required" => "La fecha es requerida",
            "status.required" => "El estado es requerido",
            "pay_status.required" => "El estado de pago es requerido",
            "observations.required" => "Las observaciones son obligatorias"
        ];
    }
}
