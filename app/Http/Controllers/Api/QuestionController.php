<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\QuestionStoreRequest;
use App\Http\Requests\Api\QuestionUpdateRequest;
use App\Http\Resources\Api\QuestionCollection;
use App\Http\Resources\Api\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\QuestionCollection
     */
    public function index(Request $request)
    {
        $questions = Question::all();

        return new QuestionCollection($questions);
    }

    /**
     * @param \App\Http\Requests\Api\QuestionStoreRequest $request
     * @return \App\Http\Resources\Api\QuestionResource
     */
    public function store(QuestionStoreRequest $request)
    {
        $question = Question::create($request->validated());

        return new QuestionResource($question);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question
     * @return \App\Http\Resources\Api\QuestionResource
     */
    public function show(Request $request, Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * @param \App\Http\Requests\Api\QuestionUpdateRequest $request
     * @param \App\Models\Question $question
     * @return \App\Http\Resources\Api\QuestionResource
     */
    public function update(QuestionUpdateRequest $request, Question $question)
    {
        $question->update($request->validated());

        return new QuestionResource($question);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Question $question)
    {
        $question->delete();

        return response()->noContent();
    }
}
