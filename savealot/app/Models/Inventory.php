<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'prod_name',
        'prod_description',
        'prod_purchase_price',
        'prod_selling_price',
        'prod_units',
        'prod_size',
        'prod_quantity',
        'prod_picture',
        'prod_color',
        'competitor_saveonfoods',
        'competitor_tnt', 
        'competitor_walmart',
    ];
}
