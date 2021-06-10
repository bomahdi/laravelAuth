<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest\CreateUser;
use App\Http\Requests\UserRequest\DeleteUser;
use App\Http\Requests\UserRequest\ReadUser;
use App\Http\Requests\UserRequest\UpdateUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function create(CreateUser $request)
    {

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        return response()->json(["data" => $user, "message" => "created_with_success"]);

    }

    public function read(ReadUser $request)
    {

        $id = (int)$request->id;
        $users = ($id) ? User::with('posts')->find($id) : User::with('posts')->get();

        return response()->json(['data' => $users]);
    }

    public function update(UpdateUser $request)
    {
        $data = [
            'name' => $request['name'],
            'email' => $request['email']
        ];
        if ($request['password']) {
            array_merge(['password' => $request['password']]);
        }
        $user = User::find($request->id);
        $user->update($data);

        return response()->json(["data" => $user, "message" => "updated_with_success"]);

    }

    public function delete(DeleteUser $request)
    {

        $user = User::find($request->id);
        $user->delete();

        return response()->json(["data" => null, "message" => "deleted_with_success"]);

    }
}
