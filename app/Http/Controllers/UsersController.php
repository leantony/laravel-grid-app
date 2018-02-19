<?php

namespace App\Http\Controllers;

use App\Grids\UsersGrid;
use App\Grids\UsersGridInterface;
use App\User;
use Illuminate\Http\JsonResponse;
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
        return $usersGrid->create(['query' => User::query(), 'request' => $request])
            ->renderOn('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function create(Request $request)
    {
        $data = [
            'model' => class_basename(User::class),
            'route' => route('users.store'),
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
     * @return JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users'
        ]);

        if (env('APP_DEBUG')) {
            $user = User::query()->create($request->all());

            return new JsonResponse([
                'success' => true,
                'message' => 'User with id ' . $user->id . ' has been created.'
            ]);
        }
        return new JsonResponse([
            'success' => true,
            'message' => 'Yes, but the db was not touched for obvious reasons'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Throwable
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
     * @return JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'email' => 'required|email|unique:users,id,' . $id,
        ]);

        $status = User::query()->findOrFail($id)->update($request->all());

        if ($status) {

            return new JsonResponse([
                'success' => true,
                'message' => 'user with id ' . $id . ' has been updated.'
            ]);
        }
        return new JsonResponse(['success' => false], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return JsonResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $status = User::query()->findOrFail($id)->delete();

        return new JsonResponse([
            'success' => $status,
            'message' => 'user with id ' . $id . ' has been deleted.'
        ]);
    }
}
