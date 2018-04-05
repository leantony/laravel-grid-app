<?php

namespace App\Http\Controllers;

use App\Grids\RolesGridInterface;
use App\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RolesGridInterface $rolesGrid
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(RolesGridInterface $rolesGrid, Request $request)
    {
        $query = Role::with('users');

        return $rolesGrid->create(['request' => $request, 'query' => $query])
            ->renderOn('render_grid', [
                'generation_command' => 'php artisan make:grid --model="App\Role"',
                'grid_code' => file_get_contents(app_path('Grids/RolesGrid.php')),
            ]);
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
            'model' => class_basename(Role::class),
            'route' => route('roles.store'),
            'action' => 'create',
            'dataVars' => [
                'pjax-target' => '#' . $request->get('ref')
            ]
        ];

        // modal
        return view('roles_modal', $data)->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles|min:3|max:30',
            'description' => 'required|max:500'
        ]);

        $user = Role::query()->create($request->all());

        return new JsonResponse([
            'success' => true,
            'message' => 'Role with id ' . $user->id . ' has been created.'
        ]);
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
        $user = Role::with('users')->findOrFail($id);

        $data = [
            'model' => class_basename(Role::class),
            'route' => route('roles.update', ['user' => $user->id]),
            'data' => $user,
            'dataVars' => [
                'pjax-target' => '#' . $request->get('ref')
            ],
            'method' => 'patch',
            'action' => 'update'
        ];

        // modal
        return view('roles_modal', $data)->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:30|unique:roles,id,' . $id,
            'description' => 'required|max:500'
        ]);

        $status = Role::query()->findOrFail($id)->update($request->all());

        if ($status) {

            return new JsonResponse([
                'success' => true,
                'message' => 'role with id ' . $id . ' has been updated.'
            ]);
        }
        return new JsonResponse(['success' => false], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
