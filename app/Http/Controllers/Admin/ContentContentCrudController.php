<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContentContentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ContentContentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContentContentCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Content\Content::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/content-content');
        CRUD::setEntityNameStrings('content content', 'content contents');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'label'     => "Category",
            'type'      => 'select',
            'name'      => 'category_id',
            'model'     => "App\Models\Content\Category",
            'attribute' => 'title',
        ]);
        CRUD::addColumn([
            'label' => 'Subcategory',
            'type' => 'enum',
            'name' => 'subcategory',
            'options' => [
                'OVERVIEW' => 'Overview',
                'CONTENT' => 'Content',
                'REVIEW' => 'Review'
            ]
        ]);
        CRUD::addColumn([
            'label' => 'Type',
            'type' => 'enum',
            'name' => 'type',
            'options' => [
                'VIDEO' => 'Video',
                'TEXT' => 'Text',
                'KAPLAN' => 'Kaplan'
            ]
        ]);
        CRUD::column('label')->type('string');
        CRUD::column('link')->type('string');
        CRUD::addColumn([
            'label' => 'Tracking',
            'type' => 'enum',
            'name' => 'tracking',
            'options' => [
                'CHECKBOX' => 'Checkbox',
                'PERCENTAGE' => 'Percentage',
                'NONE' => 'None'
            ]
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::addField([
            'label'     => "Category",
            'type'      => 'select',
            'name'      => 'category_id',
            'model'     => "App\Models\Content\Category",
            'attribute' => 'title',
        ]);
        CRUD::addField([
            'label' => 'Subcategory',
            'type' => 'enum',
            'name' => 'subcategory',
            'options' => [
                'OVERVIEW' => 'Overview',
                'CONTENT' => 'Content',
                'REVIEW' => 'Review'
            ]
        ]);
        CRUD::addField([
            'label' => 'Type',
            'type' => 'enum',
            'name' => 'type',
            'options' => [
                'VIDEO' => 'Video',
                'TEXT' => 'Text',
                'KAPLAN' => 'Kaplan'
            ]
        ]);
        CRUD::field('label')->type('text');
        CRUD::field('link')->type('text');
        CRUD::addField([
            'label' => 'Tracking',
            'type' => 'enum',
            'name' => 'tracking',
            'options' => [
                'CHECKBOX' => 'Checkbox',
                'PERCENTAGE' => 'Percentage',
                'NONE' => 'None'
            ]
        ]);
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
