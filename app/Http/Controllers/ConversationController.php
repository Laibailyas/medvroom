<?php

namespace App\Http\Controllers;

use App\Events\MessageDeleted;
use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\MessageAudit;
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
            ->with(['patient', 'doctor', 'messages' => function ($q) {
                $q->latest()->limit(1);
            }])
            ->orderByDesc('last_message_at')
            ->get()
            ->map(function ($conv) use ($user) {
                $partner = ($conv->patient_id === $user->id) ? $conv->doctor : $conv->patient;
                $conv->partner = $partner;

                return $conv;
            });

        if ($conversation) {
            $conversation->load(['patient', 'doctor']);
            $conversation->partner = ($conversation->patient_id === $user->id) ? $conversation->doctor : $conversation->patient;
            $conversation->is_active = $conversation->isActive();
        }

        return view('messages.index', compact('conversations', 'conversation'));
    }

    /**
     * Display the Messenger interface for the Doctor Portal.
     */
    public function doctorIndex(Request $request, ?Conversation $conversation = null): View
    {
        $user = $request->user();

        $conversations = Conversation::where('doctor_id', $user->id)
            ->with(['patient', 'doctor', 'messages' => function ($q) {
                $q->latest()->limit(1);
            }])
            ->orderByDesc('last_message_at')
            ->get()
            ->map(function ($conv) {
                $conv->partner = $conv->patient;

                return $conv;
            });

        if ($conversation) {
            $conversation->load(['patient', 'doctor']);
            $conversation->partner = $conversation->patient;
            $conversation->is_active = $conversation->isActive();
        }

        return view('doctor.chat.index', compact('conversations', 'conversation'));
    }

    /**
     * Fetch messages for a conversation
     */
    public function fetchMessages(Request $request, Conversation $conversation): JsonResponse
    {
        $user = $request->user();

        // Authorize: patient/provider can only access their own conversation.
        if ($user->id !== $conversation->patient_id && $user->id !== $conversation->doctor_id) {
            abort(403, 'Unauthorized.');
        }

        $isPatient = $user->id === $conversation->patient_id;

        MessageAudit::record(
            $user->id,
            $isPatient ? 'PATIENT_VIEWED_MESSAGE' : 'PROVIDER_VIEWED_MESSAGE',
            "conversation:{$conversation->id}",
            $request->ip()
        );

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
                    'message_body' => $message->message_body, // transparently decrypted via Message accessor
                    'metadata' => $message->metadata,
                    'is_deleted' => $message->is_deleted,
                    'created_at' => $message->created_at->toIso8601String(),
                ];
            });

        // Mark unread messages from the other party as read.
        $conversation->messages()
            ->where('sender_id', '!=', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json($messages);
    }

    /**
     * Send a new regular message
     */
    public function sendMessage(Request $request, Conversation $conversation): JsonResponse
    {
        $user = $request->user();

        if ($user->id !== $conversation->patient_id && $user->id !== $conversation->doctor_id) {
            abort(403, 'Unauthorized.');
        }

        if (! $conversation->isActive()) {
            return response()->json(['message' => 'Chatting is only available for confirmed appointments.'], 403);
        }

        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        // message_body is encrypted transparently by the Message model's mutator.
        $message = $conversation->messages()->create([
            'sender_id' => $user->id,
            'message_body' => $request->message,
            'metadata' => ['is_system' => false],
        ]);

        $conversation->update(['last_message_at' => now()]);

        $isPatient = $user->id === $conversation->patient_id;

        MessageAudit::record(
            $user->id,
            $isPatient ? 'PATIENT_SENT_MESSAGE' : 'PROVIDER_SENT_MESSAGE',
            "message:{$message->id}",
            $request->ip()
        );

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
        $user = $request->user();

        if ($user->id !== $message->sender_id) {
            abort(403, 'Unauthorized.');
        }

        if ($message->conversation_id !== $conversation->id) {
            abort(404, 'Message not found in this conversation.');
        }

        if (! $conversation->isActive()) {
            return response()->json(['message' => 'Cannot delete messages in read-only mode.'], 403);
        }

        // Mark as deleted and clear body for privacy (mutator skips encryption for this placeholder).
        $message->update([
            'is_deleted' => true,
            'message_body' => 'This message was deleted.',
            'metadata' => array_merge($message->metadata ?? [], ['is_deleted' => true]),
        ]);

        $isPatient = $user->id === $conversation->patient_id;

        MessageAudit::record(
            $user->id,
            $isPatient ? 'PATIENT_DELETED_MESSAGE' : 'PROVIDER_DELETED_MESSAGE',
            "message:{$message->id}",
            $request->ip()
        );

        broadcast(new MessageDeleted($message))->toOthers();

        return response()->json([
            'id' => $message->id,
            'is_deleted' => true,
            'message_body' => 'This message was deleted.',
        ]);
    }
}