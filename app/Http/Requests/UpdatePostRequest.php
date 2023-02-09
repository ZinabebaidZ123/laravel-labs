<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10']
        ];
    }
    public function messages()
    {
        return
            [
                'title.required' => 'The Title Field Is Required Yasta',
                'title.unique' => 'The Title Field Is Must Be Uniqe Yasta',
                'title.min' => 'The Title Field Has Minimum 3 Characters',
                'description.required' => 'The description Field Is Required Yasta',
                'description.min' => 'The description Field Has Minimum 10 Characters',
            ];
    }
}
