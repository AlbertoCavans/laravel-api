<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name_project" => "required|string|max:200",
            "description" => "required|string",
            "type_id" => "required|exists:types,id",
/*             'technologies' => 'required|exists:technologies,id',
            "img" => "nullable|img", */
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            "name_project.required" => "Il nome del progetto non può essere vuoto",
            "name_project.string" => "Il nome del progetto dev'essere un testo",
            "name_project.max" => "Il nome del progetto è non può superare i 200 caratteri",
            "description.required" => "La descrizione del progetto non può essere vuota",
            "description.string" => "La descrizione del progetto dev'essere un testo",
            "type_id.required" => "Bisogna scegliere una delle opzioni della select-type",
            "type_id.exists" => "Bisogna scegliere un'opzione esistente",
        ];
    }
}
