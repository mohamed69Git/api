<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ResultatStoreRequest;
use App\Http\Requests\Api\ResultatUpdateRequest;
use App\Http\Resources\Api\ResultatCollection;
use App\Http\Resources\Api\ResultatResource;
use App\Models\Resultat;
use Illuminate\Http\Request;

class ResultatController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\ResultatCollection
     */
    public function index(Request $request)
    {
        $resultats = Resultat::all();

        return new ResultatCollection($resultats);
    }

    /**
     * @param \App\Http\Requests\Api\ResultatStoreRequest $request
     * @return \App\Http\Resources\Api\ResultatResource
     */
    public function store(ResultatStoreRequest $request)
    {
        $resultat = Resultat::create($request->validated());

        return new ResultatResource($resultat);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Resultat $resultat
     * @return \App\Http\Resources\Api\ResultatResource
     */
    public function show(Request $request, Resultat $resultat)
    {
        return new ResultatResource($resultat);
    }

    /**
     * @param \App\Http\Requests\Api\ResultatUpdateRequest $request
     * @param \App\Models\Resultat $resultat
     * @return \App\Http\Resources\Api\ResultatResource
     */
    public function update(ResultatUpdateRequest $request, Resultat $resultat)
    {
        $resultat->update($request->validated());

        return new ResultatResource($resultat);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Resultat $resultat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Resultat $resultat)
    {
        $resultat->delete();

        return response()->noContent();
    }
}
