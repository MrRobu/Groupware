<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('update', Route::input('user'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = Route::input('user');

        return [
            'name' => 'required|unique:users,id,' . $user->id . '|min:6|max:255',
            'email' => 'required|unique:users,id,' . $user->id . '|email|min:6|max:255',
            'password' => 'nullable|confirmed|min:6|max:255'
        ];
    }
}
