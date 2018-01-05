<?php

namespace App\Http\Requests;

use App\Bookmark;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookmark extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $bookmark = Bookmark::find($this->route()->parameter('id'));

        return $bookmark->user_id == $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
