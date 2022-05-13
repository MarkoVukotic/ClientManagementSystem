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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:15',
            'description' => 'required|max:50',
            'deadline' => 'required',
            'status' => 'required',
            'assigned_user' => 'required',
            'assigned_client' => 'required',
        ];
    }
}
