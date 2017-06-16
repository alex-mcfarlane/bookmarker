<?php

namespace App\Validators;


class BookmarkValidator extends Validator
{
    public function getRules()
    {
        return [
            'url' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string'
        ];
    }
}