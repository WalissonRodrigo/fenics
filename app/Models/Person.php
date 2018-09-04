<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;
use App\Models\Profile;
use App\Models\Schooling;
use Backpack\CRUD\CrudTrait;

class Person extends Model
{
    use CrudTrait;

    protected $fillable = ['name', 'email', 'phone', 'birth_date', 'profile_id', 'schooling_id'];

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = (int)str_replace(["(", ")", " ", "-"], "", $value);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function schooling()
    {
        return $this->belongsTo(Schooling::class);
    }

    public function answers()
    {
        return $this->belongsToMany(Answer::class);
    }
}
