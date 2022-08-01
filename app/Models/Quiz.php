<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Quiz extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'labelle',
        'description',
        'state_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function resultats()
    {
        return $this->hasMany(Resultat::class);
    }

    /**
     * Get the state that owns the Quiz
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get all of the reponses for the Quiz
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function reponses(): HasManyThrough
    {
        return $this->hasManyThrough(Reponse::class, Question::class);
    }
}
