<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Policies\BlogPostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        BlogPost::class => BlogPostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //Define which policy to use which model with
        $this->registerPolicies();

        Gate::define('middleware-gate',function ($user){
            return $user->is_admin;
        });

        // Custom Gate without policy class
        // Always $user must add to argument
//        Gate::define('update-post',function ($user,$post){
//            return $user->id == $post->user_id;
//        });
//        Gate::define('delete-post',function ($user,$post){
//            return $user->id == $post->user_id;
//        });

        //Custom gate with policy class
//        Gate::define('posts.update','App\Policies\BlogPostPolicy@update');
//        Gate::define('posts.delete','App\Policies\BlogPostPolicy@delete');
        //Custom gate with resource modelGate::resource(`name`,`Class policy`);
//        Gate::resource('posts','App\Policies\BlogPostPolicy');//Consists:posts.create, posts.view and all methods

        // Global Gate
        // Execute before all custom gate. $ability for check specific custom gate
        Gate::before(function ($user,$ability){
            if($user->is_admin && in_array($ability,['update'])){
                return true;
            }
        });
        // Execute after all custom gate
//        Gate::after(function ($user,$ability){
//
//        });


    }
}
