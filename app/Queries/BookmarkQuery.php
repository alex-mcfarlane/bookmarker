<?php

namespace App\Queries;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class BookmarkQuery
{
    protected $builder;
    protected $validFields = [
        'started'
    ];
    protected $params;

    public function  __construct(array $params)
    {
        $this->params = $params;
    }

    public function applyFilters(Builder $queryBuilder)
    {
        $this->builder = $queryBuilder;

        foreach($this->params as $field => $value) {
            if(method_exists($this, $field)) {
                if(!is_null($value)) {
                    $this->$field($value);
                }
            }
            else if(in_array($field, $this->validFields)) {
                $this->builder->where($field, $value);
            }
        }

        return $this->builder;
    }

    private function started($date)
    {
        // validate date
        if(!$this->validateDate($date)) {
            throw new \Exception('Invalid date');
        }

        return $this->builder->where('created_at', '>', $date);
    }

    private function ended($date)
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