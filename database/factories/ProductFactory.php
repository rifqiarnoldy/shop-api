<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "user_id"   => 1,
            "name"      => fake()->unique()->word(),
            "description"   => fake()->text(),
            "spesification" => json_encode([
                "width"             => fake()->numberBetween(90, 130),
                "height"            => fake()->numberBetween(90, 130),
                "quality_check"     => "Yes",
            ]),
            "category_product_id"   => fake()->numberBetween(1, 10),
            "price"                 => fake()->randomElement([70000, 100000, 125000, 130000, 150000]),
            "images"                => json_encode([
                fake()->randomElement(['p1.jpg', 'p2.jpg', 'p3.jpg', 'p4.jpg', 'p5.jpg', 'p6.jpg', 'p7.jpg', 'p8.jpg', 'p9.jpg', 'p10.jpg', 'p11.jpg',]),
                fake()->randomElement(['p1.jpg', 'p2.jpg', 'p3.jpg', 'p4.jpg', 'p5.jpg', 'p6.jpg', 'p7.jpg', 'p8.jpg', 'p9.jpg', 'p10.jpg', 'p11.jpg',]),
            ]),
            "stock"                 => fake()->numberBetween(1, 10),
            "status"                => fake()->randomElement(['non-active', 'active']),
        ];
    }
}
