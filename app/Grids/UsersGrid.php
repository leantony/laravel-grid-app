<?php

namespace App\Grids;

use Closure;
use Leantony\Grid\Grid;

class UsersGrid extends Grid implements UsersGridInterface
{
    /**
     * The name of the grid.
     * It is used to identify the grid element on the HTML page
     * It is also used as a pjax container (if you are using pjax)
     * For pjax support check docs/javascript
     *
     * @var string
     */
    protected $name = 'Users';

    /**
     * List of buttons to be generated on the grid
     *
     * `create` - Displays a form/page/modal to create the entity
     * `view` - Displays a form/page/modal containing entity data
     * `delete` - Deletes the entity
     * `refresh` - Refreshes the grid
     * `export` - Exports the data as pdf, excel, word, or csv
     *
     * @var array
     */
    protected $buttonsToGenerate = [
        'create', 'view', 'delete', 'refresh', 'export'
    ];

    /**
     * Specify if the rows on the table should be clicked to navigate to the record
     *
     * @var bool
     */
    protected $linkableRows = false;

    /**
     * Set the rows to be displayed. Check `docs/renderRows.md` for more information
     *
     * @return void
     * @throws \Exception if an error occurs during parsing of row data
     */
    public function setRows()
    {
        $this->rows = [
		    "id" => [
		        "sort" => true,
		        "filter" => "text"
		    ],
		    "name" => [
		        "sort" => true,
		        "filter" => "text",
		        "filterOperator" => "like",
		        "searchable" => true
		    ],
		    "email" => [
		        "sort" => true,
		        "filter" => "text",
		        "filterOperator" => "like",
		        "searchable" => true
		    ],
		    "created_at" => [
		        "sort" => true,
		        "date" => "true",
		        "filter" => "date",
		        "filterOperator" => "<="
		    ]
		];
    }

    /**
     * Set the links. This are referenced by route names, for the sake of simplicity
     * This are generated in the same way that you will reference them in a resource controller
     *
     * @return void
     */
    public function setLinks()
    {
        // searching, sorting and filtering
        $this->sortRouteName = 'users.index';
        $this->searchRoute = 'users.index';

        // crud support
        $this->indexRouteName = 'users.index';
        $this->createRouteName = 'users.create';
        $this->viewRouteName = 'users.show';
        $this->deleteRouteName = 'users.destroy';
    }

    /**
    * Return a closure that is executed per row, to render a link that will be clicked on to
    * execute an action. E.g display a page, or render a modal form
    * This will only be called if the property `$linkableRows` is set to `true`
    *
    * @return Closure
    */
    public function getLinkableCallback(): Closure
    {
        $view = $this->viewRouteName;

        // the function to be executed will receive 2 parameters
        // 1: the grid's short name that can be used as a route param name. Check `$this->transformName()`
        // E.g if the grid is called `users` then the short name will be `user`
        // 2: the model instance. E.g a `$users` object
        return function ($gridName, $item) use ($view) {
            return route($view, [$gridName => $item->id]);
        };
    }

    /**
    * Configure rendered buttons, if required.
    * For example, within this function, you can call `addButton()` to add a button to the grid
    * You can also call `editButtonProperties()` to edit any properties for buttons that will be generated
    *
    * @return void
    */
    public function configureButtons()
    {
        //
    }
}