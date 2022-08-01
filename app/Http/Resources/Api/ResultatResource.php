<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'score' => $this->score,
            'user_id' => $this->user_id,
            'question_id' => $this->question_id,
            'quiz_id' => $this->quiz_id,
            'reponse_id' => $this->reponse_id,
        ];
    }
}
