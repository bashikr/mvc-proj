@extends('layouts.app')

@section('title')
    Details
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-10">
                <div class="card text-center">
                        <div class="card-header">
                            <b>TODO DETAILS</b>
                        </div>
                        <div class="card-body" style="background: {{$todo->color}}">
                            <h5 class="card-title">{{$todo->title}}</h5>
                            <p class="card-text">{{$todo->content}}</p>
                            <p class="card-text">{{$todo->starts_at}}</p>
                            <a href="{{ URL::to('edit', $todo->id)}}"><span class="btn btn-primary">Edit</span></a>
                            <a href="{{ URL::to('delete', [$todo->id, 'home'])}}"><span class="btn btn-danger">Delete</span></a>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
