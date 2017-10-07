<?php

namespace App\Queries;

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

    private function validateDate($date)
    {
        $splitDate = explode('-', $date);

        if(count($splitDate) != 3) {
            return false;
        }

        return true;
    }
}