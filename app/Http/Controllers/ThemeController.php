<?php

namespace App\Http\Controllers;

use App\Theme;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ThemeController extends Controller
{


    public function index()
    {
        $themes = Theme::all();

        return view('theme.index', [
            'themes' => $themes
        ]);
    }


    public function create()
    {
        return view('theme.create');
    }


    public function store(Request $request)
    {
        $th = Theme::create([
            'name' => $request->name,
        ]);

        Log::channel('user_channel')->info(sprintf(' Создана тема "%s" (%d) %s', $th->name, $th->id, Auth::user()->name));

        return redirect()->route('theme.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $th = Theme::find($id);

        return view('theme.edit', ['th' => $th]);
    }


    public function update(Request $request, $id)
    {
        $th = Theme::find($id);

        $th->update([
            'name' => $request->name,
        ]);

        Log::channel('user_channel')->info(sprintf(' Изменена тема "%s" (%d) %s', $th->name, $th->id, Auth::user()->name));

        return redirect()->route('theme.index');
    }


    public function destroy($id)
    {
        $th = Theme::find($id);

        $th->delete();

        Log::channel('user_channel')->info(sprintf('  Удалена тема "%s" (%d) %s', $th->name, $th->id, Auth::user()->name));

        return redirect()->route('theme.index');
    }
}
