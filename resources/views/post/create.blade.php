@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                Create Posts
                <form action="/posts" method="post">
                    @csrf
                    <input type="text" name="text">
                    <button type="submit">Submit Post</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
