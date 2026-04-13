<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function showForm()
    {
        $admins = User::where('is_admin', true)->get();

        return view('contact.admin', compact('admins'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Message::create([
            'user_id' => Auth::id(),
            'admin_id' => $request->admin_id,
            'subject' => $request->subject,
            'content' => $request->content,
            'sender_type' => 'user',
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim ke admin!');
    }

    public function myMessages()
    {
        $messages = Message::where('user_id', Auth::id())
            ->with('admin')
            ->latest()
            ->get();

        return view('contact.my-messages', compact('messages'));
    }
}
