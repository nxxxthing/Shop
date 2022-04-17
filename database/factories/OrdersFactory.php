<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user_id = User::all()->random()->getKey();
        $product_id = Product::all()->random()->getKey();
        $amount = rand(1, 5);
        $status = rand(1,4);
        $price = Product::find($product_id)->price * $amount;
        return [
            'user_id' => $user_id,
            'product_id' => $product_id,
            'amount' => $amount,
            'price' => $price,
            'status' => $status,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
