<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AnswerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AnswerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AnswerCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Answer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/answer');
        CRUD::setEntityNameStrings('answer', 'answers');
    }

    protected function setupShowOperation()
    {
        // by default the Show operation will try to show all columns in the db table,
        // but we can easily take over, and have full control of what columns are shown,
        // by changing this config for the Show operation 
        // $this->crud->set('show.setFromDb', false);

        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'user', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'User Name', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'display_name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\User::class, // foreign key model
        ],);

        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'parent', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Вопрос', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'display_name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\User::class, // foreign key model
        ],);


        // example logic
        // $this->crud->addColumn([
        //     'name' => 'score',
        //     'label' => 'Score',
        // ]);

        $this->crud->addColumn('score');
        // $this->crud->addColumn('view_count');
        // $this->crud->addColumn('answer_count');
        $this->crud->addColumn('comment_count');
        // $this->crud->addColumn('favorite_count');

        // $this->crud->addColumn('title');
        // $this->crud->addColumn('tags');

        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'tagsRelationship', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Tags', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'tag_name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\User::class, // foreign key model
        ],);


        $this->crud->addColumn('body');

        $this->crud->addColumn([
            'name'         => 'last_activity_date',
            'label'        => 'Дата последнего ответа',
        ]);


        $this->crud->addColumn('updated_at');
        $this->crud->addColumn('created_at');
        $this->crud->removeColumn('owner_user_id');
        // $this->crud->removeColumn('extras');

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
        // CRUD::column('last_activity_date');
        // CRUD::column('last_edit_date');
        // CRUD::column('last_editor_display_name');
        // CRUD::column('last_editor_user_id');
        // CRUD::column('owner_display_name');
        // CRUD::column('owner_user_id');
        // CRUD::column('parent_id');
        CRUD::column('score');

        CRUD::column('parent_id');

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

        // CRUD::column('tags');
        CRUD::column('created_at');
        // CRUD::column('updated_at');
        // CRUD::column('view_count');

    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(AnswerRequest::class);
        // CRUD::field('id');
        // CRUD::field('title');
        CRUD::field('body');

        // CRUD::field('view_count');
        CRUD::field('score');
        // CRUD::field('tags');

        CRUD::addField([
            // any type of relationship
            'name'         => 'tagsRelationship', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Tags', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'tag_name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\User::class, // foreign key model
            'ajax' => true,
            'data_source' => url("fetch/tag"),
        ],);



        // CRUD::field('accepted_answer_id');
        // CRUD::field('answer_count');
        CRUD::field('comment_count');
        // CRUD::field('favorite_count');

        // CRUD::field('closed_date');
        // CRUD::field('community_owned_date');
        CRUD::field('last_activity_date');

        CRUD::field('updated_at');
        CRUD::field('created_at');
        // CRUD::field('last_edit_date');


        // CRUD::field('content_license');


        // CRUD::field('seo_title');
        // CRUD::field('seo_description');
        // CRUD::field('seo_keywords');


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
            'ajax' => true,
            'data_source' => url("fetch/user"),
        ],);
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
