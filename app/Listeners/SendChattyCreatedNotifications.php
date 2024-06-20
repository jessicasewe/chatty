<?php

namespace App\Listeners;

use App\Events\ChattyCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\NewChatty;

class SendChattyCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChattyCreated $event): void
    {
        foreach (User::whereNot('id', $event->chatty->user_id)->cursor() as $user) {
            $user->notify(new NewChatty($event->chatty));
        }
    }
}
