<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->name();
        $image = app()->environment('testing')
            ? 'fake.jpg'
            : fake()->image('storage/app/public/images', fullPath: false, word: $title);

        return [
            'title' => $title,
            'content' => fake()->paragraph(),
            'image' => $image,
            'user_id' => User::factory()
        ];
    }
}
