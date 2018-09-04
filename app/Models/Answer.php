<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Models\Question;
use App\Models\Profile;
use App\Models\Person;

class Answer extends Model
{
    use CrudTrait;

    protected $fillable = ['description', 'question_id', 'profile_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function peoples()
    {
        return $this->belongsToMany(Person::class);
    }
}
