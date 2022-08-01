<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Question;
use App\Models\Reponse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ReponseController
 */
class ReponseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $reponses = Reponse::factory()->count(3)->create();

        $response = $this->get(route('reponse.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ReponseController::class,
            'store',
            \App\Http\Requests\Api\ReponseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $libelle = $this->faker->word;
        $type = $this->faker->word;
        $question = Question::factory()->create();

        $response = $this->post(route('reponse.store'), [
            'libelle' => $libelle,
            'type' => $type,
            'question_id' => $question->id,
        ]);

        $reponses = Reponse::query()
            ->where('libelle', $libelle)
            ->where('type', $type)
            ->where('question_id', $question->id)
            ->get();
        $this->assertCount(1, $reponses);
        $reponse = $reponses->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $reponse = Reponse::factory()->create();

        $response = $this->get(route('reponse.show', $reponse));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ReponseController::class,
            'update',
            \App\Http\Requests\Api\ReponseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $reponse = Reponse::factory()->create();
        $libelle = $this->faker->word;
        $type = $this->faker->word;
        $question = Question::factory()->create();

        $response = $this->put(route('reponse.update', $reponse), [
            'libelle' => $libelle,
            'type' => $type,
            'question_id' => $question->id,
        ]);

        $reponse->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($libelle, $reponse->libelle);
        $this->assertEquals($type, $reponse->type);
        $this->assertEquals($question->id, $reponse->question_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $reponse = Reponse::factory()->create();

        $response = $this->delete(route('reponse.destroy', $reponse));

        $response->assertNoContent();

        $this->assertModelMissing($reponse);
    }
}
