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
        $snackNames = ['Chips', 'Cookies', 'Popcorn', 'Pretzels', 'Candy'];
        $drinkNames = ['Water', 'Soda', 'Juice', 'Tea', 'Coffee'];
        $fruitNames = ['Apple', 'Banana', 'Orange', 'Grapes', 'Strawberry'];

        $productName = '';
        $productType = $this->faker->randomElement(['snack', 'drink', 'fruit']);

        switch ($productType) {
            case 'snack':
                $productName = $this->faker->unique()->randomElement($snackNames);
                break;
            case 'drink':
                $productName = $this->faker->unique()->randomElement($drinkNames);
                break;
            case 'fruit':
                $productName = $this->faker->unique()->randomElement($fruitNames);
                break;
        }

        return [
            'product_name' => $productName,
            'product_type' => $this->faker->randomElement(['snack', 'drink', 'fruit']), // Menggunakan nilai yang sesuai dengan enumerasi
            'product_price' => $this->faker->randomFloat(2, 10, 1000),
            'expired_at' => $this->faker->dateTimeBetween('+1 week', '+1 year')->format('Y-m-d H:i:s'),
        ];
    }
}