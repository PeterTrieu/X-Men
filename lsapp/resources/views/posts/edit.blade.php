@extends('layouts.app')

@section('content')

        <h1>Edit Submission</h1>
        <br>
        {!! Form::open(['action' => ['PostsController@update',$post->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('email','Email')}}
                {{Form::text('email',$post->email,['class'=>'form-control','placeholder'=>'Email'])}}
            </div>
            <div class="form-group">
                {{Form::label('description','Description')}}
                {{Form::text('description',$post->description,['class'=>'form-control','placeholder'=>'Description'])}}
            </div>
            <div class="form-group">
                {{Form::label('before_image','Before Image')}}
                 {{Form::file('before_image')}}
            </div>
            <div class="form-group">
                {{Form::label('before_image','After Image')}}
                {{Form::file('after_image')}}
            </div>
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Submit',['class'=>'form-control'])}}
        {!! Form::close() !!}
        <br>
@endsection