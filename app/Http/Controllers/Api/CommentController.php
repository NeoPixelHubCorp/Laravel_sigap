<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan semua komentar untuk sebuah keluhan tertentu
        $comments = Comment::with('user', 'replies.user') // Menampilkan data user yang memberi komentar dan balasannya
                           ->whereNull('parent_id') // Hanya komentar utama (bukan balasan)
                            ->get();

        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'complains_id' => 'required|exists:complains,id', // Pastikan complain_id ada
            'comment' => 'required|string|max:500', // Validasi komentar
            'parent_id' => 'nullable|exists:comments,id', // Pastikan parent_id ada jika ada balasan
        ]);

        // Membuat komentar baru
        $comment = new Comment([
            'complains_id' => $request->complains_id,
            'user_id' => Auth::id(), // Ambil user yang sedang login
            'comment' => $request->comment,
            'parent_id' => $request->parent_id, // Jika ada balasan
        ]);

        $comment->save();

        return response()->json($comment, 201); // Mengembalikan respons dengan status 201 Created
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan satu komentar berdasarkan ID
        $comment = Comment::with('user', 'replies.user')->findOrFail($id);

        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        // Menemukan komentar yang ingin diupdate
        $comment = Comment::findOrFail($id);

        // Memastikan hanya user yang memposting komentar yang bisa mengedit
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'You are not authorized to update this comment.'], 403);
        }

        $comment->comment = $request->comment;
        $comment->save();

        return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menemukan komentar yang akan dihapus
        $comment = Comment::findOrFail($id);

        // Memastikan hanya user yang memposting komentar yang bisa menghapus
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'You are not authorized to delete this comment.'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully.']);
    }
}
