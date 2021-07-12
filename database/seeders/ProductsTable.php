<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

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
        //creamos 10 productos de prueba y los insertamos en la base de datos
        Product::factory()
            ->count(100)
            ->create();
    }       
}
