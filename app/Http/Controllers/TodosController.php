<?php

namespace App\Http\Controllers;

use App\Todo;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $todos = DB::table('todos')->get();

        $request->session()->put('todos', $todos);

        return view('home', ['todos' => $todos]);
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $this->validate(request(), [
                'title' => ['required'],
                'date' => ['required'],
                'content' => ['required'],
                'color' => ['required'],
            ]);
        } catch (ValidationException $e) {
        }

        $data = request()->all();


        $user = Auth::user();

        $todo = new Todo([
            "title" => $data['title'],
            "content" => $data['content'],
            "starts_at" => $data['date'],
            "type" => 'text',
            /* @phpstan-ignore-next-line */
            "author_name" => $user->name,
            /* @phpstan-ignore-next-line */
            "author_email" => $user->email,
            "color" => $data['color'],
        ]);

        $todo->save();

        session()->flash('success', 'Todo created succesfully');

        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $todo = DB::table('todos')->find($id);

        /* @phpstan-ignore-next-line */
        $userEmail = Auth::user()->email;

        if ($todo && $todo->author_email === $userEmail) {
            return view('todos.edit', ['todo' => $todo]);
        } else return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function details($id)
    {
        $todo = DB::table('todos')->find($id);

        /* @phpstan-ignore-next-line */
        $userEmail = Auth::user()->email;

        if ($todo && $todo->author_email === $userEmail) {
            return view('todos.details', ['todo' => $todo]);
        } else return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Todo $todo)
    {
        try {
            $this->validate(request(), [
                'title' => ['required'],
                'date' => ['required'],
                'content' => ['required'],
                'color' => ['required'],
            ]);
        } catch (ValidationException $e) {
        }

        $data = request()->all();

        /* @phpstan-ignore-next-line */
        $res = $todo->find($data['id']);

        $res->title = $data['title'];
        $res->content = $data['content'];
        $res->starts_at = $data['date'];
        $res->type = 'text';
        /* @phpstan-ignore-next-line */
        $res->author_name = Auth::user()->name;
        /* @phpstan-ignore-next-line */
        $res->author_email = Auth::user()->email;
        $res->color = $data['color'];
        $res->save();

        session()->flash('success', 'Your note has been modified succesfully!');

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Todo $todo, $redirectTo, Request $request)
    {
        if ($redirectTo == 'home') {
            $todo->delete();

            return redirect('/');
        } elseif ($redirectTo == 'grid') {
            $todo->delete();
            $todos = DB::table('todos')->get();
            $request->session()->put('todos', $todos);

            return redirect('/grid');
        } else return redirect('/');
    }
}
