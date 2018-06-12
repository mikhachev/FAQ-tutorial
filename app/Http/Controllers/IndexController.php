<?php

namespace App\Http\Controllers;


use App\Theme;
use App\Question;

use Illuminate\Http\Request;


class IndexController extends Controller
{
    public function index()
    {
        $theme = Theme::first();
        return redirect()->route('index.theme', ['id' => $theme]);
    }

    public function indexTheme($id)
    {
        $theme = Theme::find($id);
        $themes = Theme::all();

        return view('index', [
            'theme' => $theme,
            'themes' => $themes
        ]);
    }
}
