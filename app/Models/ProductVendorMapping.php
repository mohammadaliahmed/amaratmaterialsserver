<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVendorMapping extends Model
{
    protected $table='product_vendor_mappings';
    use HasFactory;

    protected $fillable=[
        'product_id',
        'vendor_id'
    ];


    public function vendor()
    {

        return $this->hasOne('App\Models\Vendor', 'id', 'vendor_id');
    }


}
