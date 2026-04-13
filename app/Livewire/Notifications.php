<?php

namespace App\Livewire;

use App\Models\Announcement;
use App\Models\Message;
use App\Models\Warning;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifications extends Component
{
    public $notifications = [];

    public $unreadCount = 0;

    protected $listeners = ['refreshNotifications' => 'loadNotifications'];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $user = Auth::user();
        $notifications = collect();

        $activeAnnouncements = Announcement::where('is_active', true)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($a) {
                return [
                    'type' => 'announcement',
                    'title' => $a->title,
                    'message' => \Str::limit($a->content, 50),
                    'created_at' => $a->created_at,
                ];
            });

        if ($user) {
            $messages = Message::where('user_id', $user->id)
                ->where('sender_type', 'admin')
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($m) {
                    return [
                        'type' => 'message',
                        'title' => $m->subject,
                        'message' => \Str::limit($m->content, 50),
                        'created_at' => $m->created_at,
                    ];
                });

            $warnings = Warning::where('user_id', $user->id)
                ->where('is_active', true)
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($w) {
                    return [
                        'type' => 'warning',
                        'title' => 'Peringatan',
                        'message' => \Str::limit($w->reason, 50),
                        'created_at' => $w->created_at,
                    ];
                });

            $notifications = $notifications->concat($messages)->concat($warnings);
        }

        $notifications = $notifications->concat($activeAnnouncements)
            ->sortByDesc('created_at')
            ->take(10);

        $this->notifications = $notifications->values()->all();
        $this->unreadCount = $notifications->count();
    }

    public function clearAll()
    {
        $user = Auth::user();
        if (! $user) {
            return;
        }

        Message::where('user_id', $user->id)
            ->where('sender_type', 'admin')
            ->update(['is_read' => true]);

        $this->loadNotifications();
    }

    public function clearNotifications()
    {
        $user = Auth::user();
        if (! $user) {
            return;
        }

        Message::where('user_id', $user->id)
            ->where('sender_type', 'admin')
            ->delete();

        $this->loadNotifications();
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
