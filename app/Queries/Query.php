<?php

namespace App\Queries;

use Illuminate\Database\Eloquent\Builder;

abstract class Query
{
    /**
     * @var Builder
     */
    protected $builder;
    protected $validFields = [];
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
}