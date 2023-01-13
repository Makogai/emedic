<?php

namespace App\Observers;

use App\Mail\PatiendRegisteredMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PatientObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        // if the user has registration_code send email
        if ($user->registration_code) {
            Mail::to($user->email)->send(new PatiendRegisteredMail($user));
        }
    }
}
