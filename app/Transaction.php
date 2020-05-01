<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function transaction_products()
    {
        return $this->hasMany(TransactionProduct::class);
    }
}
