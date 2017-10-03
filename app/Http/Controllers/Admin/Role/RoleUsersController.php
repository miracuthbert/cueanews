<?php

namespace App\Http\Controllers\Admin\Role;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleUsersController extends Controller
{
    /**
     * RoleUsersController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Role $role)
    {
        //users
        $users = $role->users()->orderByPivot('created_at', 'desc')->paginate();

        return view('admin.roles.users.index', compact('role', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role)
    {

        $users = $request->users_ids;

        $request->validate([
            'users_ids.*' => ['required', 'integer'],
        ]);

        $role->users()->syncWithoutDetaching($users);

        return redirect()->route('admin.roles.users.index', [$role])
                ->withSuccess("Role assigned to " . count($users) . " users successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param Request $request
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        $users = $request->users_ids;

        $request->validate([
            'users_ids.*' => ['required', 'integer'],
        ]);

        $role->users()->detach($users);

        return back()->withSuccess(count($users) . " users relieved of role successfully.");
    }
}