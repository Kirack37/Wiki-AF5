<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WikiAf5Priorities;
use App\Models\WikiAf5Projects;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WikiAf5ProjectsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WikiAf5Projects::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'responsible_id' => User::inRandomOrder()->first()->id,
            'priority_id' => WikiAf5Priorities::inRandomOrder()->first()->id,
            'start_date' => now(),
            'end_date' => null,
            'description' => $this->faker->paragraphs(6, true),
            'name' => Str::random(10),
            'alias' => Str::random(4),
        ];
    }
}
