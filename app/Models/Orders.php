<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\IDinamicJobs;

class Orders extends Model 
{
    
    protected $table = 'orders';

    protected $primaryKey = 'order_id';

    protected $fillable=[
    'customer_id',
    'quantity',
    'order_type',
    'product_type', 
    'transaction_id'
    ];

    
    public function transaction()
    {
        return $this->belongsTo(\App\Models\Transaction::class, 'transaction_id', 'transaction_id');
    }
      
    public function customer()
    {
        return $this->belongsTo(\App\Models\CustomersLead::class, 'customer_id', 'customer_id');
    }

    public function orderType()
    {
        return $this->belongsTo(\App\Models\OrderType::class, 'order_type', 'order_type_id');
    }

}