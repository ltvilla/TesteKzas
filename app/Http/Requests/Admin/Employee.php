<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Employee extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'email' => (!empty($this->request->all()['id']) ? 'required|email|unique:employees,email,' . $this->request->all()['id'] : 'required|email|unique:employees,email'),
            'CPF' => (!empty($this->request->all()['id']) ? 'required|unique:employees,CPF,' . $this->request->all()['id'] : 'required|unique:employees,CPF')
        ];
    }
}
