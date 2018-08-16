<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\File;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\In;
use Psy\Util\Json;

class UserController extends Controller
{
    /**
     * get all user list
     * api/admin/user | get
     */
    public function index()
    {
        $users =  User::with('roles')->paginate(20);
        return response_success([
            'users' => $users
        ],'get all users');
    }

    /**
     *
     */
    public function create()
    {
    }

    /**
     * create user
     * api/admin/user | post
     */
    public function store(Request $request)
    {
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $userName = $request->input('userName');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $roles = $request->input('roleName');
        $roles = convertStringToArray($roles);
        $file = $request->input('avatar');
        $file = decodeImageBase64($file);
        $data = $file['data'];
        $path = "uploads/avatar";
        $extension = $file['extension'];
        $file_name = 'avatar' . '-' .time(). '.' . $extension;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        Storage::disk('public')->put($path . '/' .$file_name, $data);
        $imagePath = Storage::url( 'uploads/avatar/'.$file_name);
        $imageFullPath = 'http://movieserver.localhost:8081' . $imagePath;
        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'user_name' => $userName,
            'email' => $email,
            'password' => $password,
            'avatar' => $imageFullPath
        ]);

        foreach($roles as $role) {
            $user->roles()->attach($role);
        }

        return response_success(['user' => $user],'created user success');
    }

    /**
     *
     */
    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);

        return response_success(['user' => $user ],'edit user id ' .$user->id);
    }



    /**
     * update user by id
     * api/admin/user/id | put
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $userName = $request->input('userName');
        $email = $request->input('email');
        $file = $request->input('avatar');

        $file = decodeImageBase64($file);
        $data = $file['data'];
        $path = "uploads/avatar";
        $extension = $file['extension'];
        $file_name = 'avatar' . '-' .time(). '.' . $extension;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        Storage::disk('public')->put($path . '/' .$file_name, $data);
        $imagePath = Storage::url( 'uploads/avatar/'.$file_name);
        $imageFullPath = 'http://movieserver.localhost:8081' . $imagePath;

        $user ->update([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'user_name' => $userName,
            'email' => $email,
            'avatar' => $imageFullPath
        ]);

        return response_success([
            'user' => $user
        ], 'edit user success');
    }

    /**
     * Delete user by id
     * api/admin/user/id | delete
     */
    public function destroy($id)
    {
        $users = User::find($id);
        if($users) {
            $users->delete();
            $users->updateUserStatusDeleted($id);
            return response_success([
                'users' => $users
            ],'deleted user id ' . $id);
        }
        return response_error([

        ],'user not found');

    }

    public function testUpdate(Request $request, $id) {
        var_dump($request->input('firstName'));
        return response_success([
            'data' => $request->all()
        ]);
    }

}
