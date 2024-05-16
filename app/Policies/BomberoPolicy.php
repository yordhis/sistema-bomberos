<?php

namespace App\Policies;

use App\Models\Bombero;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BomberoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bombero  $bombero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Bombero $bombero)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bombero  $bombero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Bombero $bombero)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bombero  $bombero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Bombero $bombero)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bombero  $bombero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Bombero $bombero)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bombero  $bombero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Bombero $bombero)
    {
        //
    }
}
