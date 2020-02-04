<?php

namespace App\Policies;

use App\User;
use Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return ($user->id === $model->id) || Gate::allows('manage-users');
    }

    /**
     * Determine whether the user can delete the model.
     * @param \App\User $user
     * @param \App\User $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return Gate::allows('manage-users');
    }
}
