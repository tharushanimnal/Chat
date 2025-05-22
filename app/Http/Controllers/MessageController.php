<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewMessageNotification;

class MessageController extends Controller {
    public function index(User $user) {
        $messages = Message::where(function($q) use ($user) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $user->id);
        })->orWhere(function($q) use ($user) {
            $q->where('sender_id', $user->id)->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get();

        return view('messages.index', compact('messages', 'user'));
    }

    public function store(Request $request, User $user) {
        $validated = $request->validate(['content' => 'required']);

        $filtered = $this->filterContent($validated['content']);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'content' => $filtered,
        ]);

        $user->notify(new NewMessageNotification(Auth::user()));

        return response()->turboStreamView('messages._message', ['message' => $message]);
    }

    public function show(User $receiver)
    {
        $messages = Message::where(function ($q) use ($receiver) {
            $q->where('sender_id', auth()->id())->where('receiver_id', $receiver->id);
        })->orWhere(function ($q) use ($receiver) {
            $q->where('sender_id', $receiver->id)->where('receiver_id', auth()->id());
        })->orderBy('created_at')->get();
    
        return view('messages.show', compact('messages', 'receiver'));
    }

    public function poll(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', auth()->id());
        })->latest()->take(50)->get()->reverse(); 
    
        return view('messages.partials.chat-window', compact('messages'));
    }

    private function filterContent($content) {
        $content = preg_replace('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}\b/i', '[filtered-email]', $content);
        $content = preg_replace('/\b\d{10,13}\b/', '[filtered-phone]', $content);
        $content = preg_replace('/\b[A-Z]{2}\d{2}[A-Z0-9]{1,30}\b/', '[filtered-bank]', $content);
        return $content;
    }
}