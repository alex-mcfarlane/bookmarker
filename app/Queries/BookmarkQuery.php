<?php

namespace App\Queries;

use App\User;
use Illuminate\Support\Facades\Auth;

class BookmarkQuery extends Query
{
    protected $validFields = ['read'];

    protected function started($date)
    {
        // validate date
        if(!$this->validateDate($date)) {
            throw new \Exception('Invalid date');
        }

        return $this->builder->where('created_at', '>', $date);
    }

    protected function ended($date)
    {
        // validate date
        if(!$this->validateDate($date)) {
            throw new \Exception('Invalid date');
        }

        return $this->builder->where('created_at', '<', $date);
    }

    protected function newest($switch)
    {
        if ($switch) {
            return $this->builder->latest();
        }
        return $this->builder;
    }

    protected function owner($id)
    {
        if(User::find($id) == null) {
            throw new \Exception('No user found for the id ' . $id);
        }

        return $this->builder->where('user_id', $id);
    }

    private function validateDate($date)
    {
        $splitDate = explode('-', $date);

        if(count($splitDate) != 3) {
            return false;
        }

        return true;
    }
}