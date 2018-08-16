<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Get all role
     * api/admin/role | get
     */
    public function index()
    {
        $roles = Role::select('id','name')->get();

        return response_success([
            'roles' => $roles
        ], 'get all roles');
    }

    /**
     *
     */
    public function create()
    {
        //
    }

    /**
     * create role
     * api/admin/role | post
     */
    public function store(Request $request)
    {
        //
    }

    /**
     *
     */
    public function show($id)
    {
        //
    }

    /**
     *
     */
    public function edit($id)
    {
        //
    }

    /**
     * update role by id
     * api/admin/role/id | put
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Delete role by id
     * api/admin/role/id | delete
     */
    public function destroy($id)
    {
        //
    }
}
