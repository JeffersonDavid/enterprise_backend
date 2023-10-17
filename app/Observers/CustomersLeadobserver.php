<?php

namespace App\Observers;

use App\Models\CustomersLead;
use App\Mail\CustomerLeadsMail;
use App\Jobs\DipatcherJob;
use App\Utils\TransactionTypes;

class CustomersLeadobserver
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\CustomersLead  $transaction
     * @return void
     */
    public function created( CustomersLead $transaction)
    { 

        /*
        $mailforuser = new CustomerLeadsMail( $transaction->email, json_decode($transaction , true) );
        $execution1 = DipatcherJob::dispatch($mailforuser);
        $mailforAdmin = new CustomerLeadsMail('jeffersondvid@hotmail.com', json_decode($transaction , true));
        $execution2 = DipatcherJob::dispatch($mailforAdmin);
        */
        
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\Models\CustomersLead  $transaction
     * @return void
     */
    public function updated(CustomersLead $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\Models\CustomersLead  $transaction
     * @return void
     */
    public function deleted(CustomersLead $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\Models\CustomersLead  $transaction
     * @return void
     */
    public function restored(CustomersLead $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\Models\CustomersLead  $transaction
     * @return void
     */
    public function forceDeleted(CustomersLead $transaction)
    {
        //
    }
}
