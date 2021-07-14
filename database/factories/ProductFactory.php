<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //aqui se definen los productos de prueba que vamos a introducir en la BD
            'name' => substr($this->faker->sentence(3), 0, -1),
            'description' => $this->faker->sentence(10),
            'long_description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2,5,150),

            'category_id'=>$this->faker->numberBetween(1,5)
        ];
    }
}
