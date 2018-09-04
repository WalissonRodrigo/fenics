<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProfileRequest as StoreRequest;
use App\Http\Requests\ProfileRequest as UpdateRequest;
use App\Models\Person;

/**
 * Class ProfileCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProfileCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
         */
        $this->crud->setModel('App\Models\Profile');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/profile');
        $this->crud->setEntityNameStrings('perfil', 'perfis');

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
                'label' => 'Perfil',
                'limit' => 255
            ], [
                'name' => 'like',
                'type' => 'text',
                'label' => 'Gostos',
                'limit' => 255
            ], [
                'name' => 'values',
                'type' => 'text',
                'label' => 'Valores',
                'limit' => 255
            ], [
                'name' => 'perspective',
                'type' => 'text',
                'label' => 'Perspectivas',
                'limit' => 255
            ], [
                'name' => 'view',
                'type' => 'text',
                'label' => 'Visões',
                'limit' => 255
            ], [
                'name' => 'fear',
                'type' => 'text',
                'label' => 'Receios',
                'limit' => 255
            ]
        ]);
        //
        $this->crud->addFields([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Perfil'
            ], [
                'name' => 'like',
                'type' => 'text',
                'label' => 'Gostos'
            ], [
                'name' => 'values',
                'type' => 'text',
                'label' => 'Valores'
            ], [
                'name' => 'perspective',
                'type' => 'text',
                'label' => 'Perspectivas'
            ], [
                'name' => 'view',
                'type' => 'text',
                'label' => 'Visões'
            ], [
                'name' => 'fear',
                'type' => 'text',
                'label' => 'Receios'
            ]
        ]);
        // add asterisk for fields that are required in ProfileRequest
        if (backpack_auth()->guest()) {
            $this->crud->setShowView('vendor.backpack.crud.show_vocational');
        } else {
            $this->crud->setRequiredFields(StoreRequest::class, 'create');
            $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        }
    }

    public function showVocaional($id)
    {
        //$this->crud->hasAccessOrFail('show');

        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;

        // set columns from db
        $this->crud->setFromDb();

        // cycle through columns
        foreach ($this->crud->columns as $key => $column) {
            // remove any autoset relationship columns
            if (array_key_exists('model', $column) && array_key_exists('autoset', $column) && $column['autoset']) {
                $this->crud->removeColumn($column['name']);
            }

            // remove the row_number column, since it doesn't make sense in this context
            if ($column['type'] == 'row_number') {
                $this->crud->removeColumn($column['name']);
            }
        }

        // get the info for that entry
        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;
        $this->data['title'] = "Perfil do Teste Vocacional";
        $this->crud->removeButton('view');
        $this->crud->removeButton('delete');
        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getShowView(), $this->data);
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

    public function chartPie()
    {
        $colors = ['green', 'blue', 'cyan', 'yellow', 'orange', 'red'];
        $profiles = Person::orderBy('profile_id')->get();
        $chart = array();
        $index = 0;
        foreach ($profiles->groupBy('profile_id') as $data) {
            array_push($chart, [
                'value' => $data->count(),
                'color' => $colors[$index],
                'highlight' => $colors[$index],
                'label' => $data->first()->profile->name
            ]);
            $index++;
        }
        return json_encode($chart);
    }
}
