<?php

namespace App\Http\Controllers;

use App\Models\user;
use Laravel\Lumen\Routing\Controller as BaseController;
use illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Controller extends BaseController
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return user::all();
    }

    public function time()
    {
        $date = Carbon::now();
        return response()->json(['Time' => [
            'date' => $date->toDateTimeString(),
            'timezone_type' => $date->getTimezone()
        ]]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = user::create(
            $request->only(['username', 'password'])
        );

        return response()->json([
            'created' => true,
            'data' => $user
        ], 201);
    }


    public function update(Request $request, $id)
    {
        try {
            $user = user::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'book not found'
            ], 404);
        }

        $user->fill(
            $request->only(['username', 'password'])
        );
        $user->save();

        return response()->json([
            'updated' => true,
            'data' => $user
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $user = user::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'book not found'
                ]
            ], 404);
        }

        $user->delete();

        return response()->json([
            'deleted' => true
        ], 200);
    }
}
