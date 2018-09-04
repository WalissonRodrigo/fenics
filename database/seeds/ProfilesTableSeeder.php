<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProfilesTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Realista', 'like' => 'Uso de ferramentas e coisas', 'values' => 'Recompensa financeira para realizações mensuráveis', 'perspective' => 'Prático, conservador e prioriza mais habilidades mecânicas que sociais', 'view' => 'Normal, franco', 'fear' => 'Interação com outras pessoas', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Investigador', 'like' => 'Explorar e entender coisas e eventos', 'values' => 'Conhecimento e aprendizagem', 'perspective' => 'Analítico, inteligente, cético prioriza mais habilidades acadêmicas que sociais', 'view' => 'Inteligente e introvertido', 'fear' => 'Persuadir os demais ou vender coisas', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Artístico', 'like' => 'Ler livros, atividades artísticas, musicais e escritas', 'values' => 'Ideias criativas, emoções, sentimentos', 'perspective' => 'Aberto a experiências, inovador, intelectual, prioriza mais habilidades criativas que mecânicas', 'view' => 'Incomum, desorganizado e criativo', 'fear' => 'Rotinas e regras', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Social', 'like' => 'Ajudar, ensinar, tratar, aconselhar, servir aos demais', 'values' => 'Trabalho para o bem-estar dos demais', 'perspective' => 'Compreensivo e paciente com sentimentos alheios, prioriza habilidades sociais que mecânicas', 'view' => 'Útil, agradável e bem disposto', 'fear' => 'Atividades mecânicas e técnicas', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Empreendedor', 'like' => 'Persuadir e dirigir os demais', 'values' => 'Dinheiro e status social', 'perspective' => 'Líder, condutor, mais habilidade persuasiva que científica', 'view' => 'Energético, articulado', 'fear' => 'Tópicos científicos ou intelectuais', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Convencional', 'like' => 'Atingir objetivos claros, disciplina', 'values' => 'Dinheiro e ocupações comerciais ou políticas', 'perspective' => 'Disciplinado, coerente. Mais habilidades técnicas que artísticas', 'view' => 'Cuidadoso, seguidor de regras', 'fear' => 'Trabalhos sem direção clara', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];
        DB::table('profiles')->delete();
        Profile::insert($data);

    }
}
