<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Contracts\TransactionContract;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\EmailTransaction;
use App\Models\CustomersLead;
use App\Contracts\IDinamicJobs;


class Transaction extends Authenticatable implements IDinamicJobs 
{
    protected $table = 'transactions';
    
    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'transaction_params',
        'transaction_headers',
        'transaction_source',
        'transaction_source_ip',
        'transaction_type',
    ];


    public function EmailTransaction()
    {
        return $this->hasOne(EmailTransaction::class);
    }

    
    public function order()
    {
        return $this->hasOne( \App\Models\Orders::class , 'transaction_id', 'transaction_id');
    }


    public function customer()
    {
        return $this->hasOne( \App\Models\CustomersLead::class , 'transaction_id', 'transaction_id');
    }
  

    public function execution()
    {
       return  \App\Utils\TransactionTypes::executeTransaction($this);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = now();
            $model->updated_at = now();
        });

        static::updating(function ($model) {
            $model->updated_at = now();
        });
    }

    public function getTransactionParams(){
        
        return json_decode( $this->transaction_params , true);
    }

}