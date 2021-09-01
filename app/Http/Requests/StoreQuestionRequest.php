<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreQuestionRequest extends FormRequest
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

    public function rules(Request $request)
    {
        return [
            // 'title' => 'required|string|unique:questions,'.$request->id,
            'title' => 'required|string|unique:questions',
            'questioncategory_id' => 'required|integer',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
        ];
    }

}
