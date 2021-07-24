<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){

        return $this->belongsTo(Category::class);
    }



    public function images(){

        return $this->hasMany(ProductImage::class);
    }



    public function getFeaturedImageUrlAttribute(){

        $featuredImage = $this->images()->where('featured', true)->first(); //recupera la primera imagen destacada
        
        if(!$featuredImage){ // en caso de no haber ninguna, recupera la primera imagen no destacada

            $featuredImage = $this->images()->first();
        }

        if($featuredImage){

            //url es un atributo calculado resuelto en ProductImage.php
            return $featuredImage->url;
        }


        //default
        return '/images/default-image_product.png';
    }



    public function getCategoryNameAttribute(){

        if($this->category){

            return $this->category->name;
        }

        return 'General';
    }
}
