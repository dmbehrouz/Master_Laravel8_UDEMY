<?php

namespace App\Models;

use App\Scopes\DeletedAdminScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    protected $fillable = ['title' , 'content', 'user_id'];
    use HasFactory,SoftDeletes;

    public function comments()
    {
        //scope method of other model
        return $this->hasMany(Comment::class)->reorderShowComment();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Handle events model
    public static function boot()
    {
        //Global scope with scope class
        static::addGlobalScope(new DeletedAdminScope);
        parent::boot();
        //Global scope with Anonymous Global Scopes
        //static::addGlobalScope('ancient', function (Builder $query) {
           // $query->where('created_at', '<', now()->subYears(2000));
        //});

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

    public function scopeReorderShow(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT,'ASC');
    }

    public function scopeMostCommented(Builder $query)
    {
        // withCounts add new field to response with tableName_count
        return $query->withCount('comments')->orderBy('comments_count','DESC');
    }
}
