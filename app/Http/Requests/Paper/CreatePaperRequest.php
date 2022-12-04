<?php

namespace App\Http\Requests\Paper;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaperRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'folder_id' => 'required',
            'name' => 'required',
            'author' => 'sometimes',
            'year' => 'sometimes',
            'file' => 'required',
            'is_public' => 'required'
        ];
    }
}
