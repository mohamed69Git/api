<?php

use App\Custom\CustomResponse;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function (Request $request) {
    $validators = Validator::make($request->all(), [
        'email' => 'email|exists:users,email',
        'password' => 'required',
    ]);
    if ($validators->fails()) {
        return CustomResponse::buildValidationErrorResponse($validators->errors());
    }
    if (!Auth::attempt($request->only('email', 'password'))) {
        return CustomResponse::buildErrorResponse(["Les identifiants de connexion sont invalides..."]);
    }
    $token = $request->user()->createToken($request->email);
    return CustomResponse::buildSuccessResponse(['token' => $token->plainTextToken, 'user' => $request->user()]);
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return CustomResponse::buildSuccessResponse("");
});

Route::apiResource('question', App\Http\Controllers\Api\QuestionController::class);

Route::apiResource('reponse', App\Http\Controllers\Api\ReponseController::class);

Route::apiResource('resultat', App\Http\Controllers\Api\ResultatController::class);

Route::get('quiz', function () {
    return $quizs = Quiz::whereRelation('state', 'code', 'open')->with('questions', 'questions.reponses', 'resultats')->get();
});
