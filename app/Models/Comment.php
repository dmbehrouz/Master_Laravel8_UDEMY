<?php

namespace App\Models;

use App\Scopes\ReorderScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['content'];
    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    //Handle event model
    public static function boot()
    {
        parent::boot();

//        static::addGlobalScope(new ReorderScope);
    }

    public function scopeReorderShowComment(Builder $builder)
    {
        return $builder->orderBy(static::CREATED_AT,'DESC');
    }


}
