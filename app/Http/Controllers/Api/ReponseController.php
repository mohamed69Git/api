<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReponseStoreRequest;
use App\Http\Requests\Api\ReponseUpdateRequest;
use App\Http\Resources\Api\ReponseCollection;
use App\Http\Resources\Api\ReponseResource;
use App\Models\Reponse;
use Illuminate\Http\Request;

class ReponseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\ReponseCollection
     */
    public function index(Request $request)
    {
        $reponses = Reponse::all();

        return new ReponseCollection($reponses);
    }

    /**
     * @param \App\Http\Requests\Api\ReponseStoreRequest $request
     * @return \App\Http\Resources\Api\ReponseResource
     */
    public function store(ReponseStoreRequest $request)
    {
        $reponse = Reponse::create($request->validated());

        return new ReponseResource($reponse);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Reponse $reponse
     * @return \App\Http\Resources\Api\ReponseResource
     */
    public function show(Request $request, Reponse $reponse)
    {
        return new ReponseResource($reponse);
    }

    /**
     * @param \App\Http\Requests\Api\ReponseUpdateRequest $request
     * @param \App\Models\Reponse $reponse
     * @return \App\Http\Resources\Api\ReponseResource
     */
    public function update(ReponseUpdateRequest $request, Reponse $reponse)
    {
        $reponse->update($request->validated());

        return new ReponseResource($reponse);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Reponse $reponse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Reponse $reponse)
    {
        $reponse->delete();

        return response()->noContent();
    }
}
