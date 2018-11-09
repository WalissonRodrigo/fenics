<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ArduinoRequest as StoreRequest;
use App\Http\Requests\ArduinoRequest as UpdateRequest;

/**
 * Class ArduinoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ArduinoCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
         */
        $this->crud->setModel('App\Models\Arduino');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/arduino');
        $this->crud->setEntityNameStrings('arduino', 'arduinos');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
         */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->enableExportButtons();
        $this->crud->addColumns([
            [
                'name' => 'port',
                'type' => 'text',
                'label' => 'Porta USB'
            ], [
                'name' => 'command',
                'type' => 'text',
                'label' => 'Comando para Envio'
            ]
        ]);
        $this->crud->addFields([
            [
                'name' => 'port',
                'type' => 'text',
                'label' => 'Porta USB',
                'priority' => 1,
                'wrapperAttributes' => [
                    'class' => 'form-group col-xs-12 col-md-6'
                ]
            ], [
                'name' => 'command',
                'type' => 'text',
                'label' => 'Comando para Envio',
                'wrapperAttributes' => [
                    'class' => 'form-group col-xs-12 col-md-6'
                ]
            ]
        ]);

        // add asterisk for fields that are required in ArduinoRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
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
