@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="hello">
                    {!! $displaystring !!}
                </h3>
            </div>
        </div>
    </div>
</div>
@endsection
