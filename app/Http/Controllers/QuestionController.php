<?php

namespace App\Http\Controllers;

use App\Theme;
use App\Status;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except('create', 'store');
    }

    public function index()
    {
        $questions = Question::all();

        return view('question.index', [
            'questions' => $questions
        ]);
    }

    // вернуть страницу с вопросами по конкретной теме
    public function indexByTheme($id)
    {
        $th = Theme::find($id);
        $questions = $th->questions;

        return view('question.index', [
            'theme' => $th,
            'questions' => $questions
        ]);
    }

    //  переход на страницу создать вопрос
    public function create()
    {
        $themes = Theme::all();

        return view('question.create', [
            'themes' => $themes
        ]);
    }

    // сохранить вопрос
    public function store(Request $request)
    {
        $status = Theme::WAITING;
        $q = Question::create([
            'author' => $request->name,
            'author_email' => $request->email,
            'theme_id' => $request->theme,
            'name' => $request->qname,
            'status_id' => $status,
            'user_id' => null,
            'answer' => null,

        ]);

        Log::channel('user_channel')->info(sprintf('%s %s задал вопрос "%s" ', $q->author, $q->author_email, $q->name));

        return redirect()->route('index');
    }


    public function store_answer(Request $request, $id)
    { 

        $q = Question::find($id);
        $q->update([

            'theme_id' => $request->theme,
            'name' => $request->qname,
            'user_id' => Auth::user()->id,
            'status_id' => Theme::PUBLISHED,
            'answer' => $request->qanswer,
            'answer_created' => Carbon::now(),

        ]);

        Log::channel('user_channel')->info(sprintf('Изменен ответ на вопрос "%s" (%d) %s', $q->name, $q->id, Auth::user()->name));

        return redirect()->route('question.index');
    }

    public function show($id)
    {
        //
    }

    // переход на страницу редактирования вопроса
    public function edit($id)
    {
        $q = Question::find($id);
        $themes = Theme::all();

        return view('question.edit', [
            'q' => $q,
            'themes' => $themes,
        ]);
    }

    // ответить на вопрос
    public function create_answer($id)
    {
        $q = Question::find($id);

        return view('question.create_answer', compact('q'));
    }

    // редактирование вопроса
    public function update(Request $request, $id)
    {
        $q = Question::find($id);

        $q->update([
            'author_name' => $request->name,
            'author_email' => $request->email,
            'theme_id' => $request->theme,
            'name' => $request->qname,

        ]);

        Log::channel('user_channel')->info(sprintf('Изменен вопрос "%s" (%d) %s', $q->name, $q->id, Auth::user()->name));

        return redirect()->route('question.index');
    }

    //удаление вопроса
    public function destroy($id)
    {
        $q = Question::find($id);
        $q->delete();

        Log::channel('user_channel')->info(sprintf('Удален вопрос "%s" (%d) %s', $q->name, $q->id, Auth::user()->name));

        return redirect()->route('question.index');
    }

    //удаление ответа
    public function answer_delete($id)
    {
        $q = Question::find($id);
        $q->update([
            'answer' => null,
            'status_id' => Theme::WAITING,
            'user_id' => null,
            'answer_updated' => Carbon::now(),
            'answer_created' => null,
        ]);

        Log::channel('user_channel')->info(sprintf('Удален ответ на вопрос "%s" (%d) %s', $q->name, $q->id, Auth::user()->name));

        return redirect()->route('question.index');
    }

    // скрыть вопрос
    public function hide($id)
    {
        $q = Question::find($id);
        if ($q->status->id != Theme::HIDDEN) {
            $status = Theme::HIDDEN;
        } elseif ($q->answer) {
            $status = Theme::PUBLISHED;
        } else {
            $status = Theme::WAITING;
        }

        $q->update([
            'status_id' => $status,
        ]);
        Log::channel('user_channel')->info(sprintf(' Вопрос скрыт "%s" (%d) %s', $q->name, $q->id, Auth::user()->name));

        return redirect()->route('question.index');
    }
}
