<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentCreateRequest;
use App\Http\Requests\Comment\CommentUpdateRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function store(CommentCreateRequest $request): JsonResponse
    {
        Comment::create($request->safe()->input());

        return response()->json();
    }

    public function update(Comment $comment, CommentUpdateRequest $request): JsonResponse
    {
        $comment->update($request->safe()->input());

        return response()->json();
    }

    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();

        return response()->json();
    }
}
