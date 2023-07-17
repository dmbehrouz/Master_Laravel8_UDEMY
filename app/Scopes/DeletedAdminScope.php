<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class DeletedAdminScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        //Auth::check return boolean of user if authenticated or not
        if (Auth::check() && Auth::user()->is_admin ) {
            // query for all record. trashed and not trashed
            $builder->withTrashed();
        }
    }

}
