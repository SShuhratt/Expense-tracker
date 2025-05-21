<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'date' => $this->faker->date(),
            'category_id' => Category::where('type', 'expense')->inRandomOrder()->first()->id,
        ];
    }
}
