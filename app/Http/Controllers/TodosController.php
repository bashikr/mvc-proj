<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $todos = DB::table('todos')->get();

        $request->session()->put('todos', $todos);

        return view('home', ['todos' => $todos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
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

        $todo = new Todo();

        $todo->title = $data['title'];
        $todo->content = $data['content'];
        $todo->starts_at = $data['date'];
        $todo->type = 'text';
        $todo->author_name = Auth::user()->name;
        $todo->author_email = Auth::user()->email;
        $todo->color = $data['color'];
        $todo->save();

        session()->flash('success', 'Todo created succesfully');

        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = DB::table('todos')->find($id);

        $userEmail = Auth::user()->email;

        if ($todo && $todo->author_email === $userEmail) {
            return view('todos.edit', ['todo' => $todo]);
        } else {
            return redirect('/');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $todo = DB::table('todos')->find($id);

        $userEmail = Auth::user()->email;

        if ($todo && $todo->author_email === $userEmail) {
            return view('todos.details', ['todo' => $todo]);
        } else {
            return redirect('/');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
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

        $res = $todo->find($data['id']);

        $res->title = $data['title'];
        $res->content = $data['content'];
        $res->starts_at = $data['date'];
        $res->type = 'text';
        $res->author_name = Auth::user()->name;
        $res->author_email = Auth::user()->email;
        $res->color = $data['color'];
        $res->save();

        session()->flash('success', 'Your note has been modified succesfully!');

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect('/');
    }
}
