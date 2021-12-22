<?php

namespace App\Http\Requests\User\Checkout;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Store extends FormRequest
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
        $now = date('Y-m', time());
        return [
            'name' => 'required',
            'email' => 'required|email:dns',
            'occupation' => 'required',
            'phone' => 'required|string|max:15',
            'address' => 'required|string'
        ];
    }
}
