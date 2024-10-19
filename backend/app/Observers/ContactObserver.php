<?php

namespace App\Observers;

use App\Models\Contact;
use App\Models\User;
use App\Notifications\Admin\NewContactNotification;
use Illuminate\Support\Facades\Notification;

class ContactObserver
{
    /**
     * Handle the Contact "created" event.
     */
    public function created(Contact $contact): void
    {
        $users = User::where('role', \App\Enums\UserRole::SUPER_ADMIN)->get();
        $users->each(fn(User $user) => $user->notify(new NewContactNotification($contact)));
    }
}
