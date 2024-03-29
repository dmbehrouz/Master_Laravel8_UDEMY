<?php

namespace App\Policies;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BlogPost $blogPostModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, BlogPost $blogPostModel)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //For default create prevent gate. add return ture; to not permission
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BlogPost $blogPostModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, BlogPost $blogPostModel)
    {
        return $user->id == $blogPostModel->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BlogPost $blogPostModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, BlogPost $blogPostModel)
    {
        return $user->id == $blogPostModel->user_id;

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BlogPost $blogPostModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, BlogPostM $blogPostModel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BlogPost $blogPostModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, BlogPost $blogPostModel)
    {
        //
    }
}
