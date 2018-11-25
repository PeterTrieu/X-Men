@extends('layouts.app')

@section('content')
    <h1>Submissions for X-Mens</h1>
    @if(count($posts)>0)
        @foreach($posts as $post)
            <div class="card card-body bg-light">
                <h3><a href="/posts/{{$post->id}}">Email: {{$post->email}}</a></h3>
                <small>Written on {{$post->created_at}}</small>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection