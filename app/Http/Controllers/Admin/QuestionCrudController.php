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
            'name'         => 'answer', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Принятый Ответ', // Table column heading
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
        $this->crud->addColumn('view_count');
        $this->crud->addColumn('answer_count');
        $this->crud->addColumn('comment_count');
        $this->crud->addColumn('favorite_count');

        $this->crud->addColumn('title');
        $this->crud->addColumn('tags');

        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'tagsRelationship', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Tag 1', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'tag_name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\User::class, // foreign key model
        ],);

        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'tagsRelationshipSecond', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Tag 2', // Table column heading
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

        $this->crud->addColumn('closed_date');
        $this->crud->addColumn('updated_at');
        $this->crud->addColumn('created_at');
        // $this->crud->removeColumn('date');
        // $this->crud->removeColumn('extras');

        // Note: if you HAVEN'T set show.setFromDb to false, the removeColumn() calls won't work
        // because setFromDb() is called AFTER setupShowOperation(); we know this is not intuitive at all
        // and we plan to change behaviour in the next version; see this Github issue for more details
        // https://github.com/Laravel-Backpack/CRUD/issues/3108
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

        CRUD::addFilter(
            [
                'type'  => 'simple',
                'name'  => 'draft1',
                'label' => 'Вопросы без ответа'
            ],
            false, // the simple filter has no values, just the "Draft" label specified above
            function () { // if the filter is active (the GET parameter "draft" exits)
                CRUD::addClause('where', 'answer_count', '0');
                // we've added a clause to the CRUD so that only elements with draft=1 are shown in the table
                // an alternative syntax to this would have been
                // $this->crud->query = $this->crud->query->where('draft', '1'); 
                // another alternative syntax, in case you had a scopeDraft() on your model:
                // $this->crud->addClause('draft'); 
            }
        );

        CRUD::addFilter(
            [
                'type'  => 'simple',
                'name'  => 'draft2',
                'label' => 'Вопросы с ответом'
            ],
            false, // the simple filter has no values, just the "Draft" label specified above
            function () { // if the filter is active (the GET parameter "draft" exits)
                // CRUD::addClause('where', 'answer_count', '0');

                $this->crud->query->where('answer_count', '!=', '0');

                // we've added a clause to the CRUD so that only elements with draft=1 are shown in the table
                // an alternative syntax to this would have been
                // $this->crud->query = $this->crud->query->where('draft', '1'); 
                // another alternative syntax, in case you had a scopeDraft() on your model:
                // $this->crud->addClause('draft'); 
            }
        );

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


        // CRUD::field('content_license');


        CRUD::field('seo_title');
        CRUD::field('seo_description');
        CRUD::field('seo_keywords');


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
            'ajax' => true,
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
            'ajax' => true,
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
