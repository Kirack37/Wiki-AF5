<?php

namespace Database\Factories;

use App\Models\WikiAf5ProjectNotes;
use App\Models\WikiAf5Projects;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WikiAf5ProjectNotesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WikiAf5ProjectNotes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::where('user_type_id', '1')->inRandomOrder()->first()->id,
            'project_id' => WikiAf5Projects::inRandomOrder()->first()->id,
            'subject' => Str::random(10),
            'note' => $this->faker->paragraphs(6, true),
        ];
    }
}
