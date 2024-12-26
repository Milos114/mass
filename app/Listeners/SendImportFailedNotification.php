<?php

namespace App\Listeners;

use App\Events\ImportFailedEvent;
use App\Notifications\ImportFailedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendImportFailedNotification implements ShouldQueue
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
    public function handle(ImportFailedEvent $event): void
    {
        Notification::route('mail', config('mail.from.address'))
            ->notify(new ImportFailedNotification());
    }
}
