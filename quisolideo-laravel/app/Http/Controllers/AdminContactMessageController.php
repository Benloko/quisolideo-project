<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        $unreadCount = ContactMessage::where('read_flag', false)->count();

        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }

    public function show(ContactMessage $message)
    {
        if (!$message->read_flag) {
            $message->update(['read_flag' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function toggleRead(ContactMessage $message)
    {
        $message->update(['read_flag' => !$message->read_flag]);

        return back()->with(
            'success',
            $message->read_flag ? 'Message marqué comme lu.' : 'Message marqué comme non lu.'
        );
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Message supprimé.');
    }
}
