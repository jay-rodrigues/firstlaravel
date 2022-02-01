@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <table>
                <thead>
                    <tr>
                        <th> ID</th>
                        <th> Name</th>
                        <th> Email </th>
                        <th> View Posts</th>
                    </tr>
                    <tr style="border-bottom:1px solid black">
                        <td colspan="100%"></td>
                    </tr>
                </thead>
                <tbody>
                     @foreach($users as $user)

                      <tr>
                          <td> {{$user->id}} </td>
                          <td> {{$user->name}} </td>
                          <td> {{$user->email}} </td>
                          <td><form action="/posts/view/{{$user->id}}" method="get"><button class="view-posts-button" type="submit">See Posts</button></form></td>
                      </tr>

                     @endforeach
               </tbody>
            </table>



            </div>
        </div>
    </div>
</div>
<div class="container">

    <display-active-users> </display-active-users>
</div>
@endsection
