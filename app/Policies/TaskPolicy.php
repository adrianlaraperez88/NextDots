<?php
/**
 * Created by PhpStorm.
 * User: lara
 * Date: 12/29/16
 * Time: 11:40 PM
 */

namespace App\Policies;

use App\User;

class TaskPolicy
{
    /**
     *
     * @param  \App\User $user
     * @return bool
     */
    public function create(User $user)
    {
        // As long as the user is real, allowed
        return $user->active == 1 and $user->id != null;
    }

    /**
     *
     * @param  \App\User $user
     * @return bool
     */
    public function update(User $user)
    {
        // Only if the user is the owner of the post
        return $user->active == 1 and $user->id != null;
    }


    /**
     *
     * @param  \App\User $user
     * @return bool
     */
    public function task_users(User $user)
    {

        return $user->active == 1 and $user->id != null;
    }


    /**
     *
     * @param  \App\User $user
     * @return bool
     */
    public function assign_user(User $user)
    {

        return $user->active == 1 and $user->id != null;
    }

    /**
     *
     * @param  \App\User $user
     * @return bool
     */
    public function show(User $user)
    {
        // Only if the user is the owner of the post
        return $user->active == 1 and $user->id != null;
    }


    /**
     *
     * @param  \App\User $user
     * @return bool
     */
    public function destroy(User $user)
    {
        // Only if the user is the owner of the post
        return $user->active == 1 and $user->id != null;
    }
}