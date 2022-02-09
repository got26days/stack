<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SeoRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SeoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SeoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Seo::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/seo');
        CRUD::setEntityNameStrings('seo', 'seos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        // CRUD::column('page');

        $this->crud->addColumn([
            'name'            => 'page',
            'label'           => "Select from array",
            'type'            => 'select_from_array',
            'options'         => ['one' => 'One', 'two' => 'Two', 'three' => 'Three'],
            'allows_null'     => false,
            'allows_multiple' => true,
            'tab'             => 'Tab name here',
        ]);

        CRUD::column('seo_title');
        CRUD::column('seo_description');
        CRUD::column('seo_keywords');
        CRUD::column('created_at');
        CRUD::column('updated_at');

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
        CRUD::setValidation(SeoRequest::class);

        $this->crud->addField([
            'name'            => 'page',
            'label'           => "Страница",
            'type'            => 'select_from_array',
            'options'         => ['questions' => 'Questions', 'tags' => 'Tags', 'users' => 'Users', 'search' => "Search"],
            'allows_null'     => false,
            'allows_multiple' => false,
        ]);
        CRUD::field('seo_title');
        CRUD::field('seo_description');
        CRUD::field('seo_keywords');


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
