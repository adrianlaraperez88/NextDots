<?php
/**
 * Created by PhpStorm.
 * User: lara
 * Date: 12/29/16
 * Time: 11:40 PM
 */

namespace App\Policies;

use App\User;

class UserPolicy
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

        return $user->active == 1 and $user->id != null;
    }


    /**
     *
     * @param  \App\User $user
     * @return bool
     */
    public function user_tasks(User $user)
    {

        return $user->active == 1 and $user->id != null;
    }


    /**
     *
     * @param  \App\User $user
     * @return bool
     */
    public function assign_task(User $user)
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

        return $user->active == 1 and $user->id != null;
    }


    /**
     *
     * @param  \App\User $user
     * @return bool
     */
    public function destroy(User $user)
    {
        return $user->active == 1 and $user->id != null;
    }
}