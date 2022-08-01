<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ReponseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ReponseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ReponseCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Reponse::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/reponse');
        CRUD::setEntityNameStrings('reponse', 'reponses');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('libelle')->label('Libellé');
        CRUD::column('description')->label('Description');
        CRUD::column('type');
        CRUD::column('question_id')->label('Question');
        CRUD::column('checked')->lable('Coché');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ReponseRequest::class);

        CRUD::field('libelle');
        CRUD::field('description');
        CRUD::field('ckecked');
        CRUD::addField([
            'name'    => 'question_id',
            'label'   => 'Question',
            'type'    => 'select',
            'entity'    => 'question',
            'model'     => "App\Models\Question",
            'attribute' => 'libelle',
            'options' => (function ($query) {
                return $query->orderBy('id', 'ASC')->get();
            }),
        ]);
        CRUD::addField(
            [   // select_from_array
                'name'        => 'type',
                'label'       => "Type",
                'type'        => 'select_from_array',
                'options'     => ['vrai' => 'Vrai', 'faux' => 'Faux'],
                'allows_null' => false,
                'default'     => 'vrai',
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ]
        );

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
