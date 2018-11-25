@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default" role="button">Go Back</a>
    <br>
        <div class="card card-body bg-light">
            <h2>Email: {{$post->email}}</h2>
            <div class="col-md-4 col-sm-4">
                <p><h4>Before Image:</h4><img style="width:100%" src="/storage/before_images/{{$post->before_image}}"></p>
                <p><h4>After Image:</h4><img style="width:100%" src="/storage/after_images/{{$post->after_image}}"></p>
            </div>

            <div class="col-md-8 col-sm-8">
                <h4>Description: {{$post->description}}</h4>
                <small>Written on {{$post->created_at}}</small>
            </div>

        </div>
    <br>
    @if(!Auth::guest())    
        <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
        {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'float-right'])!!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
    <br>
@endsection