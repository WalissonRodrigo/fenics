<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Models\Person;
use App\Models\Answer;

class Question extends Model
{
    use CrudTrait;

    protected $fillable = ['description'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
