<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\QuestionController
 */
class QuestionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $questions = Question::factory()->count(3)->create();

        $response = $this->get(route('question.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\QuestionController::class,
            'store',
            \App\Http\Requests\Api\QuestionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $libelle = $this->faker->word;
        $quiz = Quiz::factory()->create();

        $response = $this->post(route('question.store'), [
            'libelle' => $libelle,
            'quiz_id' => $quiz->id,
        ]);

        $questions = Question::query()
            ->where('libelle', $libelle)
            ->where('quiz_id', $quiz->id)
            ->get();
        $this->assertCount(1, $questions);
        $question = $questions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $question = Question::factory()->create();

        $response = $this->get(route('question.show', $question));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\QuestionController::class,
            'update',
            \App\Http\Requests\Api\QuestionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $question = Question::factory()->create();
        $libelle = $this->faker->word;
        $quiz = Quiz::factory()->create();

        $response = $this->put(route('question.update', $question), [
            'libelle' => $libelle,
            'quiz_id' => $quiz->id,
        ]);

        $question->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($libelle, $question->libelle);
        $this->assertEquals($quiz->id, $question->quiz_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $question = Question::factory()->create();

        $response = $this->delete(route('question.destroy', $question));

        $response->assertNoContent();

        $this->assertModelMissing($question);
    }
}
