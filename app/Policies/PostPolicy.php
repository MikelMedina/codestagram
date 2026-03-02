<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{


    // public function __construct()
    // {
    //     $this->authorizeResource(Post::class, 'post');
    // }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        
        //FUTURE VALIDATIONS F.EX: Account Privacy
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Post $post): bool
    {


        //FUTURE VALIDATIONS F.EX: Account Privacy
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        
        //FUTURE VALIDATIONS
        return true;
    }

    // /**
    //  * Determine whether the user can update the model.
    //  */
    // public function update(User $user, Post $post): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): Response
    {
        //
       return $user->id === $post->user_id ? Response::allow() : Response::deny('Usuario no autorizado');
    }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Post $post): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Post $post): bool
    // {
    //     //
    // }

}
