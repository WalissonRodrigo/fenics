<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SchoolingRequest as StoreRequest;
use App\Http\Requests\SchoolingRequest as UpdateRequest;

/**
 * Class SchoolingCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SchoolingCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
         */
        $this->crud->setModel('App\Models\Schooling');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/schooling');
        $this->crud->setEntityNameStrings('escolaridade', 'escolaridades');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
         */

        $this->crud->enableExportButtons();
        $this->crud->addColumn([
            'name' => 'level',
            'type' => 'text',
            'label' => 'Nível de Escolaridade',
            'limit' => 255
        ]);
        $this->crud->addField([
            'name' => 'level',
            'type' => 'text',
            'label' => 'Nível de Escolaridade',
            'limit' => 255
        ]);
        // add asterisk for fields that are required in SchoolingRequest
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
