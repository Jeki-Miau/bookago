<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use App\Models\Message;
use App\Models\User;
use App\Models\Warning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'discussions' => Discussion::count(),
            'replies' => DiscussionReply::count(),
            'activeAnnouncements' => Announcement::where('is_active', true)->count(),
            'unreadMessages' => Message::where('is_read', false)->count(),
            'activeWarnings' => Warning::where('is_active', true)->count(),
        ];

        $recentDiscussions = Discussion::latest()->take(5)->get();
        $recentMessages = Message::latest()->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'recentDiscussions', 'recentMessages'));
    }

    public function announcements()
    {
        $announcements = Announcement::with('user')->latest()->get();

        return view('admin.announcements.index', compact('announcements'));
    }

    public function createAnnouncement()
    {
        return view('admin.announcements.create');
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Announcement::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'is_active' => true,
        ]);

        return redirect()->route('admin.announcements')->with('success', 'Pengumuman berhasil dibuat!');
    }

    public function editAnnouncement(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function updateAnnouncement(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $announcement->update($request->only(['title', 'content']));

        return redirect()->route('admin.announcements')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function toggleAnnouncement(Announcement $announcement)
    {
        $announcement->update(['is_active' => ! $announcement->is_active]);

        return back()->with('success', 'Status pengumuman berhasil diubah!');
    }

    public function destroyAnnouncement(Announcement $announcement)
    {
        $announcement->delete();

        return back()->with('success', 'Pengumuman berhasil dihapus!');
    }

    public function messages()
    {
        $messages = Message::with(['user', 'admin'])->latest()->get();

        return view('admin.messages.index', compact('messages'));
    }

    public function clearAllMessages()
    {
        Message::where('sender_type', 'user')->delete();

        return back()->with('success', 'Semua pesan dari user berhasil dihapus!');
    }

    public function showMessage(Message $message)
    {
        $message->update(['is_read' => true]);

        return view('admin.messages.show', compact('message'));
    }

    public function replyMessage(Request $request, Message $message)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Message::create([
            'user_id' => $message->user_id,
            'admin_id' => Auth::id(),
            'subject' => 'Re: '.$message->subject,
            'content' => $request->content,
            'sender_type' => 'admin',
            'is_read' => false,
        ]);

        return back()->with('success', 'Balasan berhasil dikirim!');
    }

    public function warnings()
    {
        $warnings = Warning::with(['user', 'admin'])->latest()->get();

        return view('admin.warnings.index', compact('warnings'));
    }

    public function createWarning()
    {
        $users = User::where('is_admin', false)->get();

        return view('admin.warnings.create', compact('users'));
    }

    public function storeWarning(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'reason' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Warning::create([
            'user_id' => $request->user_id,
            'admin_id' => Auth::id(),
            'reason' => $request->reason,
            'description' => $request->description,
            'is_active' => true,
        ]);

        return redirect()->route('admin.warnings')->with('success', 'Peringatan berhasil diberikan!');
    }

    public function toggleWarning(Warning $warning)
    {
        $warning->update(['is_active' => ! $warning->is_active]);

        return back()->with('success', 'Status peringatan berhasil diubah!');
    }

    public function destroyWarning(Warning $warning)
    {
        $warning->delete();

        return back()->with('success', 'Peringatan berhasil dihapus!');
    }

    public function users()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function discussions()
    {
        $discussions = Discussion::with('user')->latest()->get();

        return view('admin.discussions.index', compact('discussions'));
    }

    public function destroyDiscussion(Discussion $discussion)
    {
        $discussion->replies()->delete();
        $discussion->delete();

        return back()->with('success', 'Diskusi berhasil dihapus!');
    }

    public function destroyReply(DiscussionReply $reply)
    {
        $reply->delete();

        return back()->with('success', 'Balasan berhasil dihapus!');
    }
}
