<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Image;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random(1)->first()->id,
            'image_id' => Image::all()->random(1)->first()->id,
            'content' => fake()->text(30),
            'created_at' => now(),
        ];
    }
}
