<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public static $rules = [
        'name' => 'required | min:3',
        'description' => 'max:200'
    ];    

    public static $messages = [
        'name.required' => 'Es necesario introducir el nombre de la categoría',
        'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
        'description.max' => 'La descripción de la categoría debe tener al menos 200 caracteres como máximo'

    ];


    protected $fillable = [
        'name', 'description'
    ];

    public function products(){
        
        return $this->hasMany(Product::class);
    }


    public function getFeaturedImageUrlAttribute(){

        if($this->image){
            return '/images/categories/'. $this->image;
        }else{
            $firstProduct = $this->products()->first();

            if($firstProduct){
                return $firstProduct->featured_image_url;
            }else{
                return '/images/default-image_product.png';
            }
            
        }
        
    }
}
