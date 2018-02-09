<?php

namespace App\Grids;

use Leantony\Grid\Buttons\DeleteButton;
use Leantony\Grid\Grid;
use Illuminate\Support\Str;

class UsersGrid extends Grid implements UsersGridInterface
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Users';

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
     * @throws \Exception
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
		        "filter" => "text"
		    ],
		    "email" => [
		        "sort" => true,
		        "filter" => "text"
		    ],
		    "created_at" => [
		        "sort" => true,
		        "date" => "true",
                "filter" => 'date'
		    ],
            "updated_at" => [
                "sort" => true,
                "date" => "true",
                "filter" => 'date'
            ]
		];
    }

    /**
     * Set the links
     *
     * @return void
     */
    public function setLinks()
    {
        $this->sortRouteName = 'users.index';
        $this->searchRoute = 'users.index';
        $this->createRouteName = 'users.create';
        $this->viewRouteName = 'users.view';
        $this->indexRouteName = 'users.index';
        $this->deleteRouteName = 'users.delete';
    }

    /**
     * Configure rendered buttons, if need be.
     * You can do that by calling `addButton()`, or `editButtonProperties()`
     *
     * @return void
     */
    public function configureButtons()
    {
        $this->addRowButton('delete',
            (new DeleteButton([
                'gridId' => $this->id,
                'dynamicRouteName' => $this->deleteRouteName,
                'urlRenderer' => function ($grid, $item, $key) {
                    return route($this->deleteRouteName, [$grid => $item->id, 'ref' => $this->getId()]);
                }
            ]))->generate());

        $this->editRowButton('view', [
            'urlRenderer' => function ($grid, $item, $key) {
                return route($this->viewRouteName, [$grid => $item->id, 'ref' => $this->getId()]);
            }
        ]);
    }
}