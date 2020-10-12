<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use Pusher\Pusher;
use Auth;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use vendor\autoload;


class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('chat.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::find($id);
        $messages = Chat::all();
        return view('chat.chat', compact('user', 'messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Chat::create([
            'user_id' => $request->userid,
            'message' => $request->message
        ]); 
        $user = User::find(Auth::id());
        event (new ChatEvent($request->message, $user));
        $pusher = new Pusher("38cc5814880163d91ade", "2e510206343a25bd7ee0", "1088015", array('cluster' => 'ap2'));

        $pusher->trigger('chat', 'ChatEvent', array('message' => $request->message));
        
        return response()->json('ok'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
