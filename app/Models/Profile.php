<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Models\Person;
use App\Models\Answer;
///
//Class for Manager Profiles in Vocational Tests
///
class Profile extends Model
{
    use CrudTrait;

    protected $fillable = ['name', 'like', 'values', 'perspective', 'view', 'fear'];

    public function peoples()
    {
        return $this->hasMany(Person::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}