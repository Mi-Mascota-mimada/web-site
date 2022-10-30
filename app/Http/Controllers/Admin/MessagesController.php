<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {
        $allMessages = Messages::select('id', 'name', 'email', 'cel', 'created_at')->orderBy('created_at', 'desc')->get()->groupBy('email');
        return view('admin.messages.index', compact('allMessages'));
    }

    public function getMessage(Request $request)
    {
        $messagesXuser = Messages::select('message','created_at')->where('email', $request->email)->get();
        echo json_encode($messagesXuser);
    }
}
