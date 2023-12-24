<?php

namespace App\Http\Controllers\Barta;

use App\Http\Controllers\Controller;
use App\Http\Requests\Barta\StoreCommentRequest;
use App\Services\Barta\CommentService;

class CommentController extends Controller
{
    //comment post
    public function comment_post(StoreCommentRequest $request, CommentService $commentService)
    {
        $commentService->comment_post($request->all());

        return redirect()->back()->with('message', 'Comment posted successfully!');
    }
}
