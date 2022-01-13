@php
//Columns must be a factor of 12 (1,2,3,4,6,12)
$numOfCols = 4;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
@endphp
@extends('layouts.app1')

@section('title')
    Create Todo
@endsection

@section('content')
    <div class="container">

        <div class="row">
            @if ($todos != null)
                @foreach ($todos as $todo)
                    @if ($todo->author_email === $user->email)
                        <div class="col-md-{{ $bootstrapColWidth }}">
                            <div style="box-shadow: -5px 6px  10px 5px rgb(197, 196, 196); margin-top:10px;">

                                <div>
                                    <h5 class="card-header text-center" style="background: {{ $todo->color }}">
                                        {{ substr($todo->title, 0, 20) }}</h5>
                                </div>
                                <div class="card-body" style="background: {{ $todo->color }}; height: 300px;">
                                    <div class="h-75">
                                        <p class="card-text">
                                            {{ substr(wordwrap($todo->content, 30, "\n", true), 0, 300) }}
                                        </p>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-text">{{ $todo->starts_at }}</p>
                                        <a href="{{ URL::to('edit', $todo->id) }}"><span
                                                class="btn btn-primary">Edit</span></a>
                                        <a href="{{ URL::to('delete', [$todo->id, 'grid']) }}"><span
                                                class="btn btn-danger">Delete</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
@endsection
