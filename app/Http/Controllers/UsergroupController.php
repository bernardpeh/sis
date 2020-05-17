<?php

namespace App\Http\Controllers;

use App\Usergroup;
use Illuminate\Http\Request;

class UsergroupController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAll()
    {
        return response()->json(Usergroup::all());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showOne($id)
    {
        $usergroup = Usergroup::find($id);
        $users = [];
        foreach ($usergroup->users()->get() as $u) {
            $users[] = [
                'id' => $u->id,
                'first_name' => $u->first_name,
                'last_name' => $u->last_name,
                'pref_name' => $u->pref_name,
                'email' => $u->email,
                'disabled' => $u->disabled
            ];
        }
        $res = $usergroup->toArray()+['users' => $users];
        return response()->json($res);
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
            'name' => 'required',
        ]);

        $usergroup = Usergroup::create($request->all());
        return response()->json($usergroup, 201);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $usergroup = Usergroup::findOrFail($id);
        $usergroup->update($request->all());
        return response()->json($usergroup, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function delete($id)
    {
        Usergroup::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}