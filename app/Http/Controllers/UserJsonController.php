<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserJsonController extends Controller
{
    /** 
     * @return App\Models\User
    */
    public function index(Request $request)
    {
        return response([
            'data'      => User::paginate($request->offset ?? 20),
            'success'   => true
        ],200);
    }
    /**
     *
     * @return boolean
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|min:3|max:55',
            'last_name'     => 'required|string|min:3|max:55',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'required|numeric|unique:users,phone',
            'birth_date'    => 'required|date',
            'password'      => 'required|min:6'
        ]);

        DB::transaction(function () use($request) {
            User::create(
                $request->except(['password','birth_date'])+[
                    'password' => Hash::make($request->password),
                    'birth_date' => Carbon::parse($request->birth_date)->format('Y-m-d')
                ]
            );
        });

        return response([
            'success' => true,
            'message' => 'Data has been added!'
        ],200);
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|min:3|max:55',
            'last_name'     => 'required|string|min:3|max:55',
            'email'         => 'required|email|unique:users,email,'.$user->id,
            'phone'         => 'required|numeric|unique:users,phone,'.$user->id,
            'birth_date'    => 'required|date',
        ]);

        DB::transaction(function () use($request, $user) {
            $user->update($request->except(['birth_date','password']) + [
                'birth_date' => Carbon::parse($request->birth_date)->format('Y-m-d')
            ]);
        });

        return response([
            'success' => true,
            'message' => 'Data has been saved!'
        ],200);
    }

    public function show(User $user)
    {
        return response([
            'success' => true,
            'data' => $user
        ],200);
    }

    public function destroy(User $user)
    {
        DB::transaction(function() use($user) {
            $user->delete();
        });

        return response([
            'success' => true,
            'message' => 'Data has been deleted!'
        ],200);
    }
}
