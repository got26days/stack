<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'name' => "questions",
            'label' => "Questions",
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->questions()->count();
            }
        ]);

        $this->crud->addColumn([
            'name' => "answers",
            'label' => "Answers",
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->answers()->count();
            }
        ]);

        $this->crud->addColumn([
            'name' => "comments",
            'label' => "Comments",
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->comments()->count();
            }
        ]);

        CRUD::column('location');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        $this->crud->addColumn([
            'name' => "questions",
            'label' => "Questions",
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->questions()->count();
            }
        ]);

        // $this->crud->addColumn([
        //     'name' => "answers",
        //     'label' => "Answers",
        //     'type' => 'closure',
        //     'function' => function ($entry) {
        //         return $entry->answers()->count();
        //     }
        // ]);

        // $this->crud->addColumn([
        //     'name' => "comments",
        //     'label' => "Comments",
        //     'type' => 'closure',
        //     'function' => function ($entry) {
        //         return $entry->comments()->count();
        //     }
        // ]);


        CRUD::column('email');
        CRUD::column('display_name');
        CRUD::column('reputation');

        // CRUD::column('name');

        // CRUD::column('password');

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
        CRUD::setValidation(UserRequest::class);

        CRUD::field('email');
        CRUD::field('display_name');
        CRUD::field('reputation');


        CRUD::field('website_url');
        CRUD::field('about_me');
        CRUD::field('profile_image_url');
        CRUD::field('views');
        CRUD::field('last_access_date');

        CRUD::field('seo_title');
        CRUD::field('seo_description');
        CRUD::field('seo_keywords');

        // CRUD::field('password');

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
