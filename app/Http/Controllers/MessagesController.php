<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    /**
     * Display a listing of messages.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.messages.index', compact('messages'));
    }

    /**
     * Store a newly created message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->withFragment('contact');
        }

        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!')->withFragment('contact');
    }

    /**
     * Show the specified message.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\View\View
     */
    public function show(Message $message)
    {
        // Mark message as read when viewing it
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('dashboard.messages.show', compact('message'));
    }

    /**
     * Mark a message as read/unread.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleRead(Message $message)
    {
        $message->update(['is_read' => !$message->is_read]);

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message status updated successfully.');
    }

    /**
     * Remove the specified message from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
