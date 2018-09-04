<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AnswerRequest as StoreRequest;
use App\Http\Requests\AnswerRequest as UpdateRequest;
use App\Models\Answer;
use App\Models\Profile;

/**
 * Class \AnswerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AnswerCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
         */
        $this->crud->setModel(Answer::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/answer');
        $this->crud->setEntityNameStrings('resposta', 'respostas');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
         */
        $this->crud->enableExportButtons();
        $this->crud->addColumns([
            [
                'name' => 'question.description',
                'type' => 'text',
                'model' => 'App\Models\Question',
                'label' => 'Pergunta',
                'limit' => 255
            ], [
                'name' => 'description',
                'type' => 'text',
                'label' => 'Descrição',
                'priority' => 1,
                'limit' => 255
            ], [
                'name' => 'profile.name',
                'type' => 'text',
                'model' => 'App\Models\Profile',
                'label' => 'Perfil'
            ]
        ]);

        $this->crud->addFields([
            [
                'name' => 'description',
                'type' => 'text',
                'label' => 'Descrição'
            ], [
                'name' => 'question_id',
                'type' => 'select2',
                'entity' => 'question', // the method that defines the relationship in your Model
                'attribute' => 'description', // foreign key attribute that is shown to user
                'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
                'model' => 'App\Models\Question',
                'label' => 'Pergunta'
            ], [
                'name' => 'profile_id',
                'type' => 'select2',
                'entity' => 'profile', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'pivot' => false, // on create&update, do you need to add/delete pivot table entries?
                'model' => 'App\Models\Profile',
                'label' => 'Perfil'
            ]
        ]);

        // add asterisk for fields that are required in \AnswerRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }
    public function show($id)
    {
        $content = parent::show($id);

        $this->crud->removeColumn('Question');
        $this->crud->removeColumn('Profile');

        return $content;
    }
    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
