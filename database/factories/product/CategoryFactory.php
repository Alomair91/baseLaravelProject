<?php

namespace Database\Factories\product;

use App\Http\modules\products\model\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(50),
        ];
    }
}
