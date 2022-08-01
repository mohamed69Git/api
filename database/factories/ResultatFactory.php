<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Reponse;
use App\Models\Resultat;
use App\Models\User;

class ResultatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resultat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'score' => $this->faker->word,
            'user_id' => User::factory(),
            'question_id' => Question::factory(),
            'quiz_id' => Quiz::factory(),
            'reponse_id' => Reponse::factory(),
        ];
    }
}
