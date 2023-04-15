<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrdersTimeline extends Model
{
    use HasFactory;
    protected $table='customer_order_timelines';

    protected $fillable=[
        'sale_id','order_status','updated_by'
    ];


}
