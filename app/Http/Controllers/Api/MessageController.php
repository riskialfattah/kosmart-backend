<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $messages = Message::with([
            'sender',
            'receiver',
            'product',
        ])
        ->where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                  ->orWhere('receiver_id', $user->id);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json([
            'messages' => $messages,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'message' => 'required|string',
        ]);

        $user = $request->user();

        if ($user->id == $validated['receiver_id']) {
            return response()->json([
                'message' => 'Anda tidak dapat mengirim pesan kepada diri sendiri.',
            ], 422);
        }

        $product = Product::find($validated['product_id']);

        if ($product->user_id != $validated['receiver_id']) {
            return response()->json([
                'message' => 'Penerima bukan pemilik produk.',
            ], 422);
        }

        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $validated['receiver_id'],
            'product_id' => $validated['product_id'],
            'message' => $validated['message'],
        ]);

        $message->load([
            'sender',
            'receiver',
            'product',
        ]);

        return response()->json([
            'message' => 'Pesan berhasil dikirim',
            'data' => $message,
        ], 201);
    }
}