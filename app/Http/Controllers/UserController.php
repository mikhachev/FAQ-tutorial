<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('user.index', [
            'users' => $users,
        ]);
    }


    public function create()
    {

        return view('user.create');
    }


    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Log::channel('user_channel')->info(sprintf('Создан пользователь "%s" (%d) %s', $user->name, $user->id, Auth::user()->name));
        return redirect()->route('user.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', [
            'user' => $user
        ]);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        Log::channel('user_channel')->info(sprintf('Изменен пароль пользователя "%s" (%d) %s', $user->name, $user->id, ' пользователем ' . Auth::user()->name));
        return redirect()->route('user.index');
    }


    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        Log::channel('user_channel')->info(sprintf('Удален пользователь "%s" (%d) %s', $user->name, $user->id, ' пользователем ' . Auth::user()->name));
        return redirect()->route('user.index');
    }
}
