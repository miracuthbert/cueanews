<?php

namespace App\Http\Controllers\Admin\Role;

use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * RoleController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Role $roles
     * @return \Illuminate\Http\Response
     */
    public function index(Role $roles)
    {
        $roles = $roles->with(['users'])->latestFirst()->paginate();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->input('title');

        //check if assign roles
        $assignRole = $request->has('assignRole');

        $role = new Role();
        $role->title = $title;
        $role->details = $request->input('details');
        $role->status = $request->input('status');

        if ($role->save()) {

            if ($assignRole and $role->status == 1) {
                return redirect()->route('admin.roles.show', [$role])->withSuccess('Role added successfully. You can assign role now.');
            }

            return redirect()->route('admin.roles.index')->withSuccess('Role added successfully.');
        }

        //error
        return redirect()->route('admin.roles.index')->withError('Failed adding role. Try again!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //users
        $users = $role->users()->orderByPivot('created_at', 'desc')->get();
        $users = User::whereNotIn('id', $users->pluck('id'))->get();

        return view('admin.roles.show', compact('role', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $title = $request->input('title');

        //check if assign roles
        $assignRole = $request->has('assignRole');

        $role->title = $title;
        $role->details = $request->input('details');
        $role->status = $request->input('status');

        //save
        if ($role->save()) {

            if ($assignRole and $role->status == 1) {
                return redirect()->route('admin.roles.show', [$role])->withSuccess('Role updated successfully. You can assign role now.');
            } else {
                return back()->withSuccess('Role updated successfully.');
            }
        }

        //error
        return back()->withInput()->withError('Failed updating role. Try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //check if role has users
        if ($role->users->count() > 0) {
            return back()->withError('Role has users assigned to it. You can only disable it.');
        }

        //delete
        if ($role->delete()) {
            return back()->withSuccess('Role deleted successfully.');
        }
    }
}
