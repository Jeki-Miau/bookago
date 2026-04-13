<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\DiscussionReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ForumController extends Controller
{
    public function index()
    {
        $discussions = Discussion::with('user')
            ->withCount('replies')
            ->latest()
            ->paginate(15);

        return view('forum.index', compact('discussions'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('forum_images', 'public');
        }

        $discussion = Discussion::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
        ]);

        return redirect()->route('forum.show', $discussion->slug)
            ->with('success', 'Diskusi berhasil dibuat!');
    }

    public function show($slug)
    {
        $discussion = Discussion::where('slug', $slug)
            ->with(['user', 'replies.user'])
            ->firstOrFail();

        // Increment views
        $discussion->increment('views');

        return view('forum.show', compact('discussion'));
    }

    public function edit($slug)
    {
        $discussion = Discussion::where('slug', $slug)->firstOrFail();

        if ($discussion->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('forum.edit', compact('discussion'));
    }

    public function update(Request $request, $slug)
    {
        $discussion = Discussion::where('slug', $slug)->firstOrFail();

        if ($discussion->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($discussion->image) {
                Storage::disk('public')->delete($discussion->image);
            }
            $discussion->image = $request->file('image')->store('forum_images', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($discussion->image) {
                Storage::disk('public')->delete($discussion->image);
            }
            $discussion->image = null;
        }

        $discussion->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $discussion->image,
        ]);

        return redirect()->route('forum.show', $discussion->slug)
            ->with('success', 'Diskusi berhasil diperbarui!');
    }

    public function destroy($slug)
    {
        $discussion = Discussion::where('slug', $slug)->firstOrFail();

        if ($discussion->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($discussion->image) {
            Storage::disk('public')->delete($discussion->image);
        }

        // Replies and their images
        foreach ($discussion->replies as $reply) {
            if ($reply->image) {
                Storage::disk('public')->delete($reply->image);
            }
        }

        $discussion->delete();

        return redirect()->route('forum.index')->with('success', 'Diskusi berhasil dihapus.');
    }

    public function storeReply(Request $request, $slug)
    {
        $discussion = Discussion::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('forum_replies', 'public');
        }

        $discussion->replies()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
            'image' => $imagePath,
        ]);

        return redirect()->route('forum.show', $discussion->slug)
            ->with('success', 'Balasan berhasil ditambahkan!');
    }

    public function updateReply(Request $request, $id)
    {
        $reply = DiscussionReply::findOrFail($id);

        if ($reply->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($reply->image) {
                Storage::disk('public')->delete($reply->image);
            }
            $reply->image = $request->file('image')->store('forum_replies', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($reply->image) {
                Storage::disk('public')->delete($reply->image);
            }
            $reply->image = null;
        }

        $reply->update([
            'content' => $validated['content'],
            'image' => $reply->image,
        ]);

        return back()->with('success', 'Balasan berhasil diperbarui!');
    }

    public function destroyReply($id)
    {
        $reply = DiscussionReply::findOrFail($id);

        if ($reply->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($reply->image) {
            Storage::disk('public')->delete($reply->image);
        }

        $reply->delete();

        return back()->with('success', 'Balasan berhasil dihapus.');
    }
}
