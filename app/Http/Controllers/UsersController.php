<?php

namespace App\Http\Controllers;

use App\Grids\UsersGridInterface;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UsersGridInterface $usersGrid
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(UsersGridInterface $usersGrid, Request $request)
    {
        $grid = $usersGrid->create(['query' => User::query(), 'request' => $request]);

        return view('welcome', ['grid' => $grid]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [
            'model' => class_basename(User::class),
            'route' => route('users.create'),
            'action' => 'create',
            'dataVars' => [
                'pjax-target' => '#' . $request->get('ref')
            ]
        ];

        // modal
        return view('users_modal', $data)->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user = User::query()->findOrFail($id);

        $data = [
            'model' => class_basename(User::class),
            'route' => route('users.update', ['user' => $user->id]),
            'data' => $user,
            'dataVars' => [
                'pjax-target' => '#' . $request->get('ref')
            ],
            'method' => 'patch',
            'action' => 'update'
        ];

        // modal
        return view('users_modal', $data)->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
