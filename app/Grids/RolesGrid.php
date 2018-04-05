<?php

namespace App\Grids;

use Closure;
use Leantony\Grid\Grid;

class RolesGrid extends Grid implements RolesGridInterface
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Roles';

    /**
     * List of buttons to be generated on the grid
     *
     * @var array
     */
    protected $buttonsToGenerate = [
        'create', 'view', 'refresh', 'export'
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
                "label" => "ID", "filter" => ["enabled" => true, "operator" => "="],
                "styles" => ["column" => "col-md-2"]
            ],
            "name" => [
                "search" => ["enabled" => true],
                "filter" => ["enabled" => true, "operator" => "="]
            ],
            "users_count" => [
                'label' => 'Users assigned',
                'sort' => false,
                'filter' => ['enabled' => false],
                'presenter' => function($columnData, $columnName) {
                    return $columnData->users->count();
                }
            ],
            "description" => [
                "search" => ["enabled" => true],
                "data" => function ($gridItem, $columnName) {
                    // $gridItem - column object
                    // $columnName - the name of this column (ie, name)
                    return str_limit($gridItem->{$columnName}, 30);
                },
                "filter" => ["enabled" => true, "operator" => "like"],
                "styles" => ["column" => "col-md-4"]
            ],
            "created_at" => [
                "sort" => false, "date" => true,
                "filter" => ["enabled" => true, "type" => "date", "operator" => "<="]
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
        $this->sortRouteName = 'roles.index';
        $this->searchRoute = 'roles.index';

        // crud support
        $this->indexRouteName = 'roles.index';
        $this->createRouteName = 'roles.create';
        $this->viewRouteName = 'roles.show';
        $this->deleteRouteName = 'roles.destroy';
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