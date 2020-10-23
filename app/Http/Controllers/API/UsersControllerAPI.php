<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UsersControllerAPI extends Controller
{
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success = $user->createToken('nApp')->accessToken;

            $data = [
                'username' => $user->username,
                'Fullname' => $user->fullname,
                'birthOfDate' => $user->birthOfDate,
                'birthOfPlace' => $user->birthOfPlace,
                'gender' => $user->gender,
                'role' => $user->role->name,
                'token' => $success
            ];

            return response()->json([
                'data' => $data
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'fullname' => 'required',
            'birthOfDate' => 'required',
            'birthOfPlace' => 'required',
            'gender' => 'required',
            'password' => 'required',
            'id_role' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('nApp')->accessToken;
            $success['name'] =  $user->name;

            return response()->json(['success' => $success], 200);
        }
    }
}
