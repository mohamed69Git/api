<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\Reponse;
use App\Models\Resultat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ResultatController
 */
class ResultatControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $resultats = Resultat::factory()->count(3)->create();

        $response = $this->get(route('resultat.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ResultatController::class,
            'store',
            \App\Http\Requests\Api\ResultatStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $score = $this->faker->word;
        $user = User::factory()->create();
        $question = Question::factory()->create();
        $quiz = Quiz::factory()->create();
        $reponse = Reponse::factory()->create();

        $response = $this->post(route('resultat.store'), [
            'score' => $score,
            'user_id' => $user->id,
            'question_id' => $question->id,
            'quiz_id' => $quiz->id,
            'reponse_id' => $reponse->id,
        ]);

        $resultats = Resultat::query()
            ->where('score', $score)
            ->where('user_id', $user->id)
            ->where('question_id', $question->id)
            ->where('quiz_id', $quiz->id)
            ->where('reponse_id', $reponse->id)
            ->get();
        $this->assertCount(1, $resultats);
        $resultat = $resultats->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $resultat = Resultat::factory()->create();

        $response = $this->get(route('resultat.show', $resultat));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ResultatController::class,
            'update',
            \App\Http\Requests\Api\ResultatUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $resultat = Resultat::factory()->create();
        $score = $this->faker->word;
        $user = User::factory()->create();
        $question = Question::factory()->create();
        $quiz = Quiz::factory()->create();
        $reponse = Reponse::factory()->create();

        $response = $this->put(route('resultat.update', $resultat), [
            'score' => $score,
            'user_id' => $user->id,
            'question_id' => $question->id,
            'quiz_id' => $quiz->id,
            'reponse_id' => $reponse->id,
        ]);

        $resultat->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($score, $resultat->score);
        $this->assertEquals($user->id, $resultat->user_id);
        $this->assertEquals($question->id, $resultat->question_id);
        $this->assertEquals($quiz->id, $resultat->quiz_id);
        $this->assertEquals($reponse->id, $resultat->reponse_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $resultat = Resultat::factory()->create();

        $response = $this->delete(route('resultat.destroy', $resultat));

        $response->assertNoContent();

        $this->assertModelMissing($resultat);
    }
}
