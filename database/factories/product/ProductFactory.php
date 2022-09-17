<?php

namespace Database\Factories\product;

use App\Http\modules\products\model\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
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
            'category_id' => mt_rand(1, 10),
            'brand_id' => mt_rand(1, 10),

            'name' => $this->faker->text(50),
            'details' => $this->faker->paragraph(),

            'price' => mt_rand(10, 50),
        ];
    }
}
