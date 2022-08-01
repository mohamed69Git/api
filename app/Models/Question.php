<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libelle',
        'description',
        'quiz_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'quiz_id' => 'integer',
    ];

    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }

    public function resultats()
    {
        return $this->hasMany(Resultat::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
