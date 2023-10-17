<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Workflow;

class CustomersLead extends Model
{
   
    public $type;
    
    protected $table = 'customers_leads';

    protected $primaryKey = 'customer_id';

   
    protected $fillable = ['name', 'email', 'phone', 'transaction_id'];


    public function transaction()
    {
        return $this->belongsTo( \App\Models\Transaction::class, 'transaction_id', 'transaction_id' );
    }


    public function order()
    {
        return $this->hasOne( \App\Models\Orders::class , 'customer_id', 'customer_id');
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

}

