<?php

namespace App\Listeners\Profile;

use App\Events\Profile\ProfileUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\User\ProfileUpdated as ProfileUpdatedNotification;

class NotifyUserProfileUpdated implements ShouldQueue
{
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProfileUpdated  $event
     * @return void
     */
    public function handle(ProfileUpdated $event)
    {
        $event->user->notify(new ProfileUpdatedNotification($event->user));
    }
}
