<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class IdeaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $random_title = $this->faker->words(4, true);
        return [
            'user_id' => User::get()->random()->id,
            'title' => ucwords($random_title),
            'description' => $this->faker->paragraph(5)
        ];
    }
}
