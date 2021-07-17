<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;

class ProductsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //model factories

        /*
        //creamos 5 categorías de prueba
        Category::factory()
            ->count(5)
            ->create();


        //creamos 10 productos de prueba y los insertamos en la base de datos
        Product::factory()
            ->count(100)
            ->create();


        //creamos 200 imagenes 
        ProductImage::factory()
            ->count(200)
            ->create();
        */

        //creamos 5 categorías de prueba
        $categories = Category::factory()
            ->count(4)
            ->create();

        //creamos 20 productos para cada categoría    
        $categories->each(function($category){

            $products = Product::factory()
                            ->count(5)
                            ->make();

            $category->products()->saveMany($products);


            //creamos 5 imagenes para cada producto
            $products->each(function($p){

                $images = ProductImage::factory()
                            ->count(3)
                            ->make();
                $p->images()->saveMany($images);
            });
        });



        /*$users = factory(App\User::class, 3)
            ->create()
            ->each(function($u){
                $u->posts()->save(factory(App\Post::class)->make());
            });*/    
    }       
}
