<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\PersonRequest as StoreRequest;
use App\Http\Requests\PersonRequest as UpdateRequest;
use App\Models\Question;
use App\Models\Person;
use App\Models\Answer;
use App\Models\Profile;
use App\Models\Schooling;

/**
 * Class PersonCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PersonCrudController extends CrudController
{

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
         */
        $this->crud->setModel('App\Models\Person');
        if (backpack_auth()->guest()) {
            $this->crud->setRoute(route('vocational.create'));
            $this->crud->setEntityNameStrings('', 'Teste Vocacional');
        } else {
            $this->crud->setRoute(config('backpack.base.route_prefix') . '/person');
            $this->crud->setEntityNameStrings('Teste', 'Teste Vocacional');
        }

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
         */

        $this->crud->enableExportButtons();
        $this->crud->allowAccess('show');
        $this->crud->addColumns([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Nome Completo'
            ], [
                'name' => 'profile.name',
                'type' => 'text',
                'model' => 'App\Models\Profile',
                'label' => 'Perfil'
            ], [
                'name' => 'phone',
                'type' => 'text',
                'label' => 'Telefone Contato'
            ], [
                'name' => 'email',
                'type' => 'text',
                'label' => 'E-mail'
            ], [
                'name' => 'schooling.level',
                'type' => 'text',
                'model' => 'App\Models\Schooling',
                'label' => 'Nível de Escolaridade'
            ], [
                'name' => 'birth_date',
                'type' => 'date',
                'label' => 'Data de Nascimento',
                'format' => 'd/m/Y'
            ]
        ]);
        if (backpack_auth()->guest()) {
            $this->crud->addField([   // CustomHTML
                'name' => 'separator0',
                'type' => 'custom_html',
                'value' => '<div class="box-header with-border"><h3 class="box-title">Dados para Pessoais</h3></div>'
            ]);
        }
        $this->crud->addFields([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Nome Completo',
                'wrapperAttributes' => [
                    'class' => 'col-md-6'
                ]
            ], [
                'name' => 'email',
                'type' => 'text',
                'label' => 'E-mail',
                'wrapperAttributes' => [
                    'class' => 'col-md-6'
                ]
            ]
        ]);
        $this->crud->addFields([
            [   // CustomHTML
                'name' => 'separator1',
                'type' => 'custom_html',
                'value' => '<p></p>'
            ], [
                'name' => 'phone',
                'type' => 'phone',
                'label' => 'Telefone Contato',
                'wrapperAttributes' => [
                    'class' => 'col-md-4'
                ]
            ], [
                'name' => 'birth_date',
                'type' => 'date',
                'label' => 'Data de Nascimento',
                'default' => '2000-01-01',
                'wrapperAttributes' => [
                    'class' => 'col-md-4'
                ]
            ], [
                'name' => 'schooling_id',
                'type' => 'select2',
                'entity' => 'schooling',
                'attribute' => 'level',
                'pivot' => false,
                'model' => 'App\Models\Schooling',
                'label' => 'Nível de Escolaridade',
                'default' => 3,
                'wrapperAttributes' => [
                    'class' => 'col-md-4'
                ]
            ]
        ]);
        $questions = Question::orderByRaw("RAND()")->get();
        $answers = Answer::orderByRaw("RAND()")->get();
        $formProfile = array();
        foreach ($questions as $q) {
            $formAnswer = array();
            foreach ($answers->where('question_id', $q->id) as $a) {
                $formAnswer[$a->profile_id] = $a->description;
            }
            array_push($formProfile, [
                'name' => "profile[" . $q->id . "]",
                'label' => $q->description, // the input label
                'type' => 'radio',
                'key' => "$q->id",
                'options' => $formAnswer,
                'inline' => false
            ]);
        }
        $this->crud->addField([   // CustomHTML
            'name' => 'separator2',
            'type' => 'custom_html',
            'value' => '<br><div class="box-header with-border"><h3 class="box-title">Dados para Avaliação</h3></div>'
        ]);
        $this->crud->addFields($formProfile);
        if (backpack_auth()->guest()) {
            $this->crud->setCreateView('vendor.backpack.crud.create_vocational');
            //$this->crud->setRequiredFields(StoreRequest::class, 'create');
        } else {
            $this->crud->setRequiredFields(StoreRequest::class, 'create');
            $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        }
        // add asterisk for fields that are required in PersonRequest
    }

    public function show($id)
    {
        $content = parent::show($id);
        $this->crud->removeColumn('profile_id');
        $this->crud->removeColumn('schooling_id');
        return $content;
    }

    public function store(StoreRequest $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|min:5|max:255',
            'phone' => 'required',
            'birth_date' => 'required|date',
            'profile' => 'required|array',
            'schooling_id' => 'required|numeric'
        ], [
            'email.email' => 'O campo Email deve conter a estrutura de um email real.',
            'name.required' => 'O campo Nome é obrigatório.',
            'email.required' => 'O campo Email é obrigatório.',
            'phone.required' => 'O campo Telefone é obrigatório.',
            'birth_date.required' => 'O campo Data de Nascimento é obrigatório.',
            'profile.required' => 'Escolher alternativas entre todas as perguntas do Teste Vocacional é obrigatório',
            'schooling_id.required' => 'O campo Nível de Escolaridade é obrigatório.',
            'birth_date.date' => 'Apenas Datas são aceitas no campo de Data de Nascimento',
            'profile.array' => 'Responder ao Teste Vocacional é obrigatório',
            'schooling_id.numeric' => 'Pelo menos 1 opção para o Nível de Escolaridade deve ser preenchido.'
        ]);
        $request['phone'] = (int)str_replace(["(", ")", " ", "-"], "", $request['phone']);
        $request['profile_id'] = self::filterProfile($request);
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $request['phone'] = (int)str_replace(["(", ")", " ", "-"], "", $request['phone']);
        $request['profile_id'] = self::filterProfile($request);
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function createVocational()
    {
        //$this->crud->hasAccessOrFail('createVocational');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['route'] = route('vocational.store');
        $this->data['saveAction'] = $this->getSaveAction();
        $this->data['fields'] = $this->crud->getCreateFields();
        $this->data['title'] = "Novo Teste Vocacional";

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('vendor.backpack.crud.create_vocational', $this->data);
    }

    public function storeVocational(Request $request)
    {
        //$this->crud->hasAccessOrFail('create');

        // fallback to global request instance
        if (is_null($request)) {
            $request = \Request::instance();
        }

        // replace empty values with NULL, so that it will work with MySQL strict mode on
        foreach ($request->input() as $key => $value) {
            if (empty($value) && $value !== '0') {
                $request->request->set($key, null);
            }
        }
        $this->validate($request, [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|min:5|max:255',
            'phone' => 'required',
            'birth_date' => 'required|date',
            'profile' => 'required|array',
            'schooling_id' => 'required|numeric'
        ], [
            'email.email' => 'O campo Email deve conter a estrutura de um email real.',
            'name.required' => 'O campo Nome é obrigatório.',
            'email.required' => 'O campo Email é obrigatório.',
            'phone.required' => 'O campo Telefone é obrigatório.',
            'birth_date.required' => 'O campo Data de Nascimento é obrigatório.',
            'profile.required' => 'Escolher alternativas entre todas as perguntas do Teste Vocacional é obrigatório',
            'schooling_id.required' => 'O campo Nível de Escolaridade é obrigatório.',
            'birth_date.date' => 'Apenas Datas são aceitas no campo de Data de Nascimento',
            'profile.array' => 'Responder ao Teste Vocacional é obrigatório',
            'schooling_id.numeric' => 'Pelo menos 1 opção para o Nível de Escolaridade deve ser preenchido.'
        ]);

        $request['phone'] = (int)str_replace(["(", ")", " ", "-"], "", $request['phone']);
        $request['profile_id'] = self::filterProfile($request);

        // insert item in the db
        $item = $this->crud->create($request->except(['save_action', '_token', '_method', 'current_tab']));
        return redirect()->route('vocational.show', $request->profile_id);
    }

    public function filterProfile($request)
    {
        //Return ID on Profile using options send by user on page.

        //transform profile on request in collection and remove sub division collection
        $profileForm = collect($request->only('profile'))->collapse();
        //get all IDs profiles stored on database order of id;
        $possibleProfiles = Profile::select("id")->orderBy("id")->get();
        //filter all IDs to generate new collect objects
        $profilesFilteds = $possibleProfiles->map(function ($item, $key) use ($profileForm) {
            //filter profiles in request form to store on return
            $filted = $profileForm->filter(function ($item2, $key2) use ($item) {
                return (int)$item2 == $item->id;
            }); 
            //return a new object with ID and Count Options selectds with user on form           
            return (object)["id" => $item->id, "count" => $filted->count()];
        });
        //When profiles ared filted column count have max count on any option and this is return object max value
        $filtedCountMax = $profilesFilteds->max('count');
        //created a new variable with value ID stored on collection but after return max value on variable using where return a new collection on values with max count exists.
        //case have more options all as sorted and return first ID
        $idProfileFilter = $profilesFilteds->where('count', $filtedCountMax)->sort()->first()->id;
        return $idProfileFilter;
    }
}
