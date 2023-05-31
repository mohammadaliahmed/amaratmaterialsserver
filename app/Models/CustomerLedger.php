<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLedger extends Model
{
    use HasFactory;
    protected $table='customer_ledger';
    protected $fillable=[
        'amount','type','date','customer_id'
    ];
}
