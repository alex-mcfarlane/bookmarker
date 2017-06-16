<?php

namespace App\Validators;

use Validator as V;

abstract class Validator
{
    protected $errors;

    /**
     * @return array
     */
    public abstract function getRules();

    public function validate($attrs)
    {
        $validator = V::make($attrs, $this->getRules());

        if($validator->fails()) {
            $this->errors = $validator->messages();

            return false;
        }

        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}