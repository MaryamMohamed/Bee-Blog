<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use lluminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => 2,
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph,
            
        ];
    }
}
