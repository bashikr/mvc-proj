@extends('layouts.app1')

@section('title')
    Create Todo
@endsection

@section('content')
    <div class="card ">
        <ul class="list-group">
            <div class="card-body" style="background: {{$todo->color}}">
                <h5 class="card-title">{{$todo->title}}</h5>
                {{-- <p class="card-text">{{$todo->author}}</p> --}}
                <p class="card-text">{{$todo->content}}</p>
                <p class="card-text">{{$todo->starts_at}}</p>
                <a href="{{ URL::to('edit', $todo->id)}}"><span class="btn btn-primary">Edit</span></a>
                <a href="{{ URL::to('delete', $todo->id)}}"><span class="btn btn-danger">Delete</span></a>
            </div>
            {{-- @foreach ($todos as $todo)
                <li class="list-group-item"><a href="{{ URL::to('details', $todo->id) }}"
                        style="color: cornflowerblue">{{ $todo->title }}</a></li>
            @endforeach --}}
        </ul>
    </div>
@endsection
