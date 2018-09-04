<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\Models\Schooling;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SchoolingsTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['level' => 'Analfabeto', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['level' => 'Ensino Fundamental Completo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['level' => 'Ensino Médio Completo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['level' => 'Ensino Superior Completo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['level' => 'Pós Graduado Completo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['level' => 'Mestrado Completo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['level' => 'Doutorado Completo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['level' => 'Ensino Fundamental Incompleto', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['level' => 'Ensino Médio Incompleto', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['level' => 'Ensino Superior Incompleto', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['level' => 'Pós Graduado Incompleto', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['level' => 'Mestrado Incompleto', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['level' => 'Doutorado Incompleto', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];
        DB::table('schoolings')->delete();
        Schooling::insert($data);
    }
}
