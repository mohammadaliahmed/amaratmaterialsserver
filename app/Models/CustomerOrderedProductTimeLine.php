<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrderedProductTimeLine extends Model
{
    use HasFactory;
    protected $table='customer_ordered_product_timeline';

    protected $fillable=[
        'selled_item_id','product_id','status','updated_by'
    ];
}
