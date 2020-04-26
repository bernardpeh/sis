<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllUsers()
    {
        return response()->json(User::all());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showOneUser($id)
    {
        return response()->json(User::find($id));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        // validate request
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'pref_name' => 'required|alpha',
            'email' => 'required|email|unique:users'
        ]);

        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}