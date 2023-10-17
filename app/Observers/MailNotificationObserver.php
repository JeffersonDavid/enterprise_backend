<?php

namespace App\Observers;

use App\Models\MailNotifications;
use App\Jobs\DipatcherJob;

class MailNotificationObserver
{
    /**
     * Handle the MailNotifications "created" event.
     *
     * @param  \App\Models\MailNotifications  $mailNotification
     * @return void
     */
    public function created( MailNotifications $mailNotification)
    {

        logger()->info('-----------------notification created---------------');
         
        $mailService = new \App\Mail\CustomerLeadsMail ( $mailNotification );

        logger()->info('---');

        return DipatcherJob::dispatch( $mailService );

    }

    /**
     * Handle the MailNotifications "updated" event.
     *
     * @param  \App\Models\MailNotifications  $mailNotification
     * @return void
     */
    public function updated(MailNotifications $mailNotification)
    {
        //
    }

    /**
     * Handle the MailNotifications "deleted" event.
     *
     * @param  \App\Models\MailNotifications  $mailNotification
     * @return void
     */
    public function deleted(MailNotifications $mailNotification)
    {
        //
    }

    /**
     * Handle the MailNotifications "restored" event.
     *
     * @param  \App\Models\MailNotifications  $mailNotification
     * @return void
     */
    public function restored(MailNotifications $mailNotification)
    {
        //
    }

    /**
     * Handle the MailNotifications "force deleted" event.
     *
     * @param  \App\Models\MailNotifications  $mailNotification
     * @return void
     */
    public function forceDeleted(MailNotifications $mailNotification)
    {
        //
    }
}
