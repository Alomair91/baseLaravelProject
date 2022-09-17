<?php

namespace Database\Seeders;

use App\Http\modules\products\model\Brand;
use App\Http\modules\products\model\Category;
use App\Http\modules\products\model\Product;
use App\Http\modules\user\model\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // user
        User::factory(10)->create();

        // product
        Category::factory(10)->create();
        Brand::factory(10)->create();
        Product::factory(100)->create();
    }
}
