<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['description' => 'Quando faz um trabalho em grupo, você é aquele (a) que:', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'Você imagina se destacar profissionalmente...', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'Você gosta mais de atividades que envolvam...', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'Em uma discussão, você....', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'Seus amigos te descreveriam como uma pessoa...', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'O emprego ideal é aquele no qual você....', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'O que você mais valoriza...', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'De modo geral, você evita ou não gosta de:', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'O que mais te incomoda é quando as pessoas...', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'para você, um bom professor é aquele que...', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'Na sala de aula, você...', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'Qual destas situações abaixo você se sente mais confortável?', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'Nos seus relacionamentos, você costuma ser...', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'Qual palavra combina mais com você?', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['description' => 'Com qual frase você mais se identifica?', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];
        DB::table('questions')->delete();
        Question::insert($data);
    }
}
