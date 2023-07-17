<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ReorderScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // USE EVERY TYPE OF QUERY LIKE WHERE ORDERBY AND ..
        // $builder->orderBy('created_at','DESC');
        // Use $model to assign created_at const model  to define automatically
        $builder->orderBy($model::CREATED_AT,'DESC');
    }

}
