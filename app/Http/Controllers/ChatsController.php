<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use App\Models\User;
//https://www.youtube.com/watch?v=OHhvhMUWB9g
//Video used to create this
class ChatsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chats');
    }

    public function fetchMessages()
    {
        //Need clarification of what this does
        return Message::with('user')->get();
    }
    public function sendMessage(Request $request)
    {
        //Need clarificaiton of how this works
        $message = auth()->user()->messages()->create([
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return ['status' => 'success'];
    }
}
