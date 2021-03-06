<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->realText(30),
            'description'=> $this->faker->realText(360),
            'url'=> $this->faker->url(),
            'user_id' => 1,
            'category_id' => $this->faker->numberBetween(1, 4)
        ];
    }
}
