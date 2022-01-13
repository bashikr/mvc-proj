@extends('layouts.app')
@section('title')
    Edit Todo
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <b>Edit Note</b>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <form action="update" method="post" class="p-4">
                        @csrf

                        <div class="form-group m-3">
                            <input type="number" hidden class="form-control" name="id" value="{{ $todo->id }}">
                        </div>
                        <div class="form-group m-3">
                            <label for="title">Todo Name</label>
                            <input type="text" class="form-control" name="title" value="{{ $todo->title }}">
                        </div>
                        <div class="form-group m-3">
                            <label for="date">Todo Date</label>
                            <input type="date" class="form-control" name="date" value="{{ $todo->starts_at }}">
                        </div>
                        <div class="container">
                            <label for="name">Note Color</label>
                            <div id="cp2" class="input-group colorpicker colorpicker-component">

                                <input type="text" value="{{ $todo->color }}" class="form-control" name="color" />

                                <span class="input-group-addon"><i style="padding: 18.5px; margin-top:-1.7px;"></i></span>

                            </div>
                        </div>
                        <div class="form-group m-3">
                            <label for="content">Todo Description</label>
                            <textarea class="form-control" name="content" rows="3"
                                required>{{ $todo->content }}</textarea>
                        </div>
                        <div class="form-group m-3 text-center">
                            <input type="submit" class="btn btn-primary float-end" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.colorpicker').colorpicker();
    </script>
@endsection
