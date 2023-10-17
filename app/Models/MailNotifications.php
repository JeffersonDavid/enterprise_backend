<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailNotifications extends Model
{
    use HasFactory;

    protected $table = 'mail_notifications';

    protected $fillable = [
        'customer_id',
        'transaction_type',
        'transaction_id'
    ];

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


        static::retrieved(function ($model) {

            $model->customer_data =  \App\Models\CustomersLead::find( $model->customer_id );
            $model->customer_transaction_data =  \App\Models\Transaction::find( $model->transaction_id );

        });
    }

 
}
