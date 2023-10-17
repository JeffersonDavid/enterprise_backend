<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Transaction;
use App\Contracts\TransactionContract;

class CreateTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public array $transaction_data;
    
    public function __construct( array $transaction_data ){
       $this->setTransactionData($transaction_data);
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function setTransactionData(array $transaction_data){
        $this->transaction_data = $transaction_data;
    }

    public function handle() 
    {
         Transaction::create($this->transaction_data); 
        
    }
}
