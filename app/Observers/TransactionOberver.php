<?php

namespace App\Observers;

use App\Models\Transaction;

use Illuminate\Support\Facades\App;

use \App\Utils\TransactionTypes;
use \App\Jobs\DipatcherJob;

class TransactionOberver
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created( Transaction $transaction )
    { 
        $data = $transaction->getTransactionParams();

        $selectedFields = array_intersect_key( $data, array_flip ([
            'name',
            'email',
            'phone',
        ]));

        $data['transaction_id'] = $transaction->transaction_id;

        $lead = \App\Models\CustomersLead::create( $data );

        //añadir una tabla que se llame email_notifications y hacer insert aqui

        return DipatcherJob::dispatch( $transaction );
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
