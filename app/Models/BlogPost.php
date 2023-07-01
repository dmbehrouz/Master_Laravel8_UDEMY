<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    protected $fillable = ['title' , 'content'];
    use HasFactory,SoftDeletes;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //Handle event model
    public static function boot()
    {
        parent::boot();
        //Because we add comments to blog post and when i delete blog post must deleted all comments before that
        // we will use this model event or use field with cascade rule foreign key
        static::deleting(function(BlogPost $bp){
            $bp->comments()->delete();
        });
        //Restore all relations record comment too.
        static::restoring(function(BlogPost $bp){
            $bp->comments()->restore();
        });
    }
}
