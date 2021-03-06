<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TagCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Tag::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/tag');
        CRUD::setEntityNameStrings('tag', 'tags');
    }

    protected function setupShowOperation()
    {
        CRUD::column('id');

        CRUD::column('count');


        CRUD::column('tag_name');

        CRUD::column('updated_at');
        CRUD::column('created_at');

        CRUD::column('excerpt_post_id');
        CRUD::column('wiki_post_id');

        $this->crud->addColumn([
            'name' => "questions",
            'label' => "Questions",
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->tagsRelationship()->count() + $entry->tagsRelationshipSecond()->count();
            }
        ]);


        $this->crud->addColumn([
            'name' => "answers",
            'label' => "Answers",
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->tagsRelationshipAnswer()->count();
            }
        ]);


        $this->crud->addColumn([
            'name' => "questions_without_answer",
            'label' => "Without answers",
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->tagsRelationship()->where('answer_count', 0)->count()
                    + $entry->tagsRelationshipSecond()->where('answer_count', 0)->count();
            }
        ]);

        $this->crud->addColumn([
            'name' => "views",
            'label' => "View count",
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->tagsRelationship()->sum('view_count')
                    + $entry->tagsRelationshipSecond()->sum('view_count') +
                    $entry->tagsRelationshipAnswer()->sum('view_count');
            }
        ]);
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

        CRUD::column('count');


        CRUD::column('tag_name');

        CRUD::column('updated_at');
        CRUD::column('created_at');

        CRUD::column('excerpt_post_id');
        CRUD::column('wiki_post_id');

        $this->crud->addColumn([
            'name' => "questions",
            'label' => "Questions",
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->tagsRelationship()->count() + $entry->tagsRelationshipSecond()->count();
            }
        ]);


        $this->crud->addColumn([
            'name' => "answers",
            'label' => "Answers",
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->tagsRelationshipAnswer()->count();
            }
        ]);


        $this->crud->addColumn([
            'name' => "questions_without_answer",
            'label' => "Without answers",
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->tagsRelationship()->where('answer_count', 0)->count()
                    + $entry->tagsRelationshipSecond()->where('answer_count', 0)->count();
            }
        ]);

        $this->crud->addColumn([
            'name' => "views",
            'label' => "View count",
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->tagsRelationship()->sum('view_count')
                    + $entry->tagsRelationshipSecond()->sum('view_count') +
                    $entry->tagsRelationshipAnswer()->sum('view_count');
            }
        ]);

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
        CRUD::setValidation(TagRequest::class);

        CRUD::field('tag_name');
        CRUD::field('count');
        CRUD::field('excerpt_post_id');
        CRUD::field('wiki_post_id');



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
