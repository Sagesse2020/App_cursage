<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CommentController extends Controller
{
   
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string',
        ]);

        Comment::create([

            // IMPORTANT
            'user_id' => auth()->id(),

            'content' => $request->content,

            'commentable_id' => $request->commentable_id,

            'commentable_type' => $request->commentable_type,
        ]);

        return back()->with('success', 'Commentaire ajouté');
    }
    public function destroy(Comment $comment)
    {
        // sécurité : seul l’auteur ou admin peut supprimer
        if ($comment->user_id !== Auth::user()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Commentaire supprimé');
    }
}
