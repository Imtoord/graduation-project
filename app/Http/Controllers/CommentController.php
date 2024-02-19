<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function allComments()
    {
        $comments = Comment::with('user')->get();
        return response()->json(['comments' => $comments], 200);
    }

   public function show($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            return response()->json($comment, 200);
        } else {
            // Comment not found, return an error response
            return response()->json(['error' => 'comment not found'], 404);
        }
    }


    public function createComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UserID' => 'required|exists:users,id',
            'Rating' => 'required|numeric',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Automatically add the current date
        $request->merge(['date' => Carbon::now()]);

        $comment = Comment::create($request->all());

        return response()->json(['comment' => $comment], 201);
    }

    public function updateComment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Rating' => 'nullable|numeric',
            'content' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $comment = Comment::findOrFail($id);
            $comment->update($request->all());

            return response()->json(['comment' => $comment], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Comment not found'], 404);
        }
    }

    public function deleteComment($id)
    {
        // $comment = Comment::find($id);
        // if ($comment) {
        //     $comment->delete();
        //     return response()->json(['message' => 'Comment deleted successfully'], 200);
        // } else {
        //     return response()->json(['error' => 'Comment not found'], 404);
        // }
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();

            return response()->json(['message' => 'Comment deleted successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Comment not found'], 404);
        }
    }
}
