<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConversationController extends Controller
{
    /**
     * Display the Messenger interface.
     */
    public function index(Request $request, ?Conversation $conversation = null): View
    {
        $user = $request->user();
        
        $conversations = Conversation::where('patient_id', $user->id)
            ->orWhere('doctor_id', $user->id)
            ->with(['patient', 'doctor', 'messages' => function($q) {
                $q->latest()->limit(1);
            }])
            ->orderByDesc('last_message_at')
            ->get()
            ->map(function ($conv) use ($user) {
                // Determine who the partner is
                $partner = ($conv->patient_id === $user->id) ? $conv->doctor : $conv->patient;
                $conv->partner = $partner;
                return $conv;
            });

        // Set partner for the active conversation if provided
        if ($conversation) {
            $conversation->load(['patient', 'doctor']);
            $conversation->partner = ($conversation->patient_id === $user->id) ? $conversation->doctor : $conversation->patient;
        }

        return view('messages.index', compact('conversations', 'conversation'));
    }

    /**
     * Fetch messages for a conversation
     */
    public function fetchMessages(Request $request, Conversation $conversation): JsonResponse
    {
        // Authorize
        if ($request->user()->id !== $conversation->patient_id && $request->user()->id !== $conversation->doctor_id) {
            abort(403, 'Unauthorized.');
        }

        $messages = $conversation->messages()
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'conversation_id' => $message->conversation_id,
                    'sender_id' => $message->sender_id,
                    'sender_name' => $message->sender->name ?? 'System',
                    'message_body' => $message->message_body,
                    'metadata' => $message->metadata,
                    'is_deleted' => $message->is_deleted,
                    'created_at' => $message->created_at->toIso8601String(),
                ];
            });

        return response()->json($messages);
    }

    /**
     * Send a new regular message
     */
    public function sendMessage(Request $request, Conversation $conversation): JsonResponse
    {
        // Authorize
        if ($request->user()->id !== $conversation->patient_id && $request->user()->id !== $conversation->doctor_id) {
            abort(403, 'Unauthorized.');
        }

        $request->validate([
            'message' => 'required|string|max:2000'
        ]);

        $message = $conversation->messages()->create([
            'sender_id' => $request->user()->id,
            'message_body' => $request->message,
            'metadata' => ['is_system' => false],
        ]);

        $conversation->update(['last_message_at' => now()]);

        broadcast(new MessageSent($message))->toOthers();

        $message->load('sender');

        return response()->json([
            'id' => $message->id,
            'conversation_id' => $message->conversation_id,
            'sender_id' => $message->sender_id,
            'sender_name' => $message->sender->name ?? 'System',
            'message_body' => $message->message_body,
            'metadata' => $message->metadata,
            'is_deleted' => $message->is_deleted,
            'created_at' => $message->created_at->toIso8601String(),
        ]);
    }

    /**
     * Delete a message (mark as deleted)
     */
    public function deleteMessage(Request $request, Conversation $conversation, Message $message): JsonResponse
    {
        // Authorize: Only the sender can delete their message
        if ($request->user()->id !== $message->sender_id) {
            abort(403, 'Unauthorized.');
        }

        // Verify message belongs to conversation
        if ($message->conversation_id !== $conversation->id) {
            abort(404, 'Message not found in this conversation.');
        }

        // Mark as deleted and clear body for privacy
        $message->update([
            'is_deleted' => true,
            'message_body' => 'This message was deleted.',
            'metadata' => array_merge($message->metadata ?? [], ['is_deleted' => true])
        ]);

        broadcast(new \App\Events\MessageDeleted($message))->toOthers();

        return response()->json([
            'id' => $message->id,
            'is_deleted' => true,
            'message_body' => 'This message was deleted.'
        ]);
    }
}
