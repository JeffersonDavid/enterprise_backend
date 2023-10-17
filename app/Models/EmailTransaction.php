<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class EmailTransaction extends Model
{
    protected $fillable = ['mail_to', 'data', 'transaction_id'];

    protected $casts = [
        'data' => 'json',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
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