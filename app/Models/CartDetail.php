<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{

    //establece la relación N-1 entre CartDetail y Product
    public function product(){

        return $this->belongsTo(Product::class);
    }
}
