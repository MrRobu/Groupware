<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use Illuminate\Support\Facades\Gate;

class ReviewCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('create', Review::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'post_id' => [
                'required',
                'exists:posts,id',
                Rule::unique('reviews')->where(function ($query) {
                    return $query->where('post_id', Request::get('post_id'))
                        ->where('user_id', Auth::user()->id);
                })
            ],
            'rating' => 'required|min:1|max:10',
            'body' => 'required'
        ];
    }
}
