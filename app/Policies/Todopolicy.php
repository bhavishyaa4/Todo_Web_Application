<?php

namespace App\Policies;

use App\Models\Applicant;
use App\Models\Todo;
use Illuminate\Auth\Access\Response;

class Todopolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Applicant $applicant): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Applicant $applicant, Todo $todo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Applicant $applicant): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Applicant $applicant, Todo $todo): bool
    {
        return $applicant->id === $todo->applicant_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Applicant $applicant, Todo $todo): bool
    {
        return $applicant->id === $todo->applicant_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Applicant $applicant, Todo $todo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Applicant $applicant, Todo $todo): bool
    {
        return false;
    }
}
