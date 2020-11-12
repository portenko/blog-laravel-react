<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => rtrim($this->faker->text(rand(25,60)), '.'),
            'body' => $this->faker->text(1000),
            'created_at' => $this->faker->dateTimeBetween('-10 days'),
            'updated_at' => now(),
        ];
    }
}
