@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">

                <table>
                    <thead>
                        <tr>
                            <th> Created By</th>
                            <th> Text</th>
                            <th> Created Time </th>

                        </tr>
                        <tr style="border-bottom:1px solid black">
                            <td colspan="100%"></td>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($posts as $post)

                        <tr>
                            <td> {{$post->user_id}} </td>
                            <td> {{$post->text}} </td>
                            <td> {{$post->created_at}} </td>
                        </tr>


                         @endforeach
                   </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
