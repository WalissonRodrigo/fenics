<?php

namespace App\Models;

use App\Models\Person;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Schooling extends Model
{
    use CrudTrait;

    protected $fillable = ['level'];

    public function peoples()
    {
        return $this->hasMany(Person::class);
    }
}
