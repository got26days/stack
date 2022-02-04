<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuestionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class QuestionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class QuestionCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Question::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/question');
        CRUD::setEntityNameStrings('question', 'questions');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::column('accepted_answer_id');
        // CRUD::column('answer_count');
        // CRUD::column('body');
        // CRUD::column('closed_date');
        // CRUD::column('comment_count');
        // CRUD::column('community_owned_date');
        // CRUD::column('content_license');

        // CRUD::column('favorite_count');
        CRUD::column('id');
        // CRUD::column('last_activity_date');
        // CRUD::column('last_edit_date');
        // CRUD::column('last_editor_display_name');
        // CRUD::column('last_editor_user_id');
        // CRUD::column('owner_display_name');
        // CRUD::column('owner_user_id');
        // CRUD::column('parent_id');
        CRUD::column('score');

        CRUD::column('title');

        CRUD::addColumn([
            // any type of relationship
            'name'         => 'user', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'User Name', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'display_name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\User::class, // foreign key model
        ],);

        CRUD::column('tags');
        CRUD::column('created_at');
        // CRUD::column('updated_at');
        CRUD::column('view_count');

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
        CRUD::setValidation(QuestionRequest::class);
        // CRUD::field('id');
        CRUD::field('title');
        CRUD::field('body');

        CRUD::field('view_count');
        CRUD::field('score');
        CRUD::field('tags');

        CRUD::field('accepted_answer_id');
        CRUD::field('answer_count');
        CRUD::field('comment_count');
        CRUD::field('favorite_count');

        CRUD::field('closed_date');
        CRUD::field('community_owned_date');
        CRUD::field('last_activity_date');
        CRUD::field('updated_at');
        CRUD::field('created_at');
        // CRUD::field('last_edit_date');


        CRUD::field('content_license');


        // CRUD::field('last_editor_display_name');
        // CRUD::field('last_editor_user_id');
        // CRUD::field('owner_display_name');
        // CRUD::field('owner_user_id');
        // CRUD::field('parent_id');



        CRUD::addField([
            // any type of relationship
            'name'         => 'user', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'User Name', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'display_name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\User::class, // foreign key model
        ],);

        CRUD::addField([
            // any type of relationship
            'name'         => 'tagsRelationship', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Tags', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'tag_name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\User::class, // foreign key model
        ],);

        CRUD::addField([
            // any type of relationship
            'name'         => 'tagsRelationshipSecond', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Tags', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'tag_name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\User::class, // foreign key model
        ],);

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
