<?php

namespace App\Http\Controllers;

use App\Theme;
use App\Forbidden_word;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ForbiddenController extends Controller
{


    public function index()
    {
        $fwords = Forbidden_word::all();

        return view('theme.index', ['themes' => $themes]);
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

        Log::channel('user_channel')->info(" Создана тема \"{$th->name}\" ({$th->id}) " . Auth::user()->name);

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


    public function destroy($id)
    {
        $th = Theme::find($id);
        $th->delete();

        Log::channel('user_channel')->info(" Удалена тема \"{$th->name}\" ({$th->id})" . Auth::user()->name);

        return redirect()->route('theme.index');
    }
}
