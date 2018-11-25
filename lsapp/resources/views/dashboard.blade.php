@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <h3>Welcome back, X-Mens</h3>
                        <a href="/posts" class="btn btn-primary">Go to Submissions</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
