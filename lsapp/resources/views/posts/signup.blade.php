@extends('layouts.app')

@guest
        @section('content')
                <br>
                <h1>Welcome to the X-Mens</h1>
                <h2>Do you have what it takes to be a X-Men?</h2>
                <p>Please attach a before and after picture of yourself and as well as your email and a short description of your SUPERPOWER</p>
                <br>

                {!! Form::open(['action' => 'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                        {{Form::label('email','Email')}}
                        {{Form::text('email','',['class'=>'form-control','placeholder'=>'Email'])}}
                </div>
                <div class="form-group">
                        {{Form::label('description','Description')}}
                        {{Form::text('description','',['class'=>'form-control','placeholder'=>'Description'])}}
                </div>
                <div class="form-group">
                        {{Form::label('before_image','Before Image')}}
                        {{Form::file('before_image')}}
                </div>
                <div class="form-group">
                        {{Form::label('before_image','After Image')}}
                        {{Form::file('after_image')}}
                </div>
                {{Form::submit('Submit',['class'=>'form-control'])}}
                {!! Form::close() !!}
                <br>
        @endsection
@else
        <script>window.location = "/dashboard";</script>
@endguest