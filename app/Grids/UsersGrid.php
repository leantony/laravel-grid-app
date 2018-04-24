<?php

namespace App\Grids;

use App\Role;
use Closure;
use Leantony\Grid\Grid;

class UsersGrid extends Grid implements UsersGridInterface
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Users';

    /**
     * List of buttons to be generated on the grid
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
     * Set the columns to be displayed. Check `docs/customize_columns.md` for more information
     *
     * @return void
     * @throws \Exception if an error occurs during parsing of the data
     */
    public function setColumns()
    {
        $this->columns = [
            "id" => [
                "label" => "ID",
                "filter" => ["enabled" => true, "operator" => "="],
            ],
            "name" => [
                "search" => ["enabled" => true],
                "filter" => ["enabled" => true, "operator" => "="]
            ],
            "created_at" => [
                "sort" => false, "date" => true,
                "filter" => ["enabled" => true, "type" => "daterange"]
            ],
            "role_id" => [
                'label' => 'Role',
                'export' => false,
                'search' => ['enabled' => false],
                'presenter' => function ($columnData, $columnName) {
                    return $columnData->role->name;
                },
                'filter' => [
                    'enabled' => true,
                    'type' => 'select',
                    'data' => Role::query()->pluck('name', 'id')
                ]
            ],
            "email" => [
                "search" => ["enabled" => true],
                "filter" => ["enabled" => true, "operator" => "="]
            ]
        ];
    }

    /**
     * Set the links/routes. This are referenced using named routes, for the sake of simplicity
     *
     * @return void
     */
    public function setRoutes()
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
     * Return a closure that is executed per row, to render a link that will be clicked on to execute an action
     *
     * @return Closure
     */
    public function getLinkableCallback(): Closure
    {
        $view = $this->viewRouteName;

        return function ($gridName, $item) use ($view) {
            return route($view, [$gridName => $item->id]);
        };
    }

    /**
     * Configure rendered buttons, or add your own
     *
     * @return void
     */
    public function configureButtons()
    {
        //
    }

    /**
     * Returns a closure that will be executed to apply a class for each row on the grid
     * The closure takes two arguments - `name` of grid, and `item` being iterated upon
     *
     * @return Closure
     */
    public function getRowCssStyle(): Closure
    {
        return function ($gridName, $item) {
            return "";
        };
    }
}