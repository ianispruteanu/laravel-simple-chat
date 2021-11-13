<?php

namespace Pruteanu\InterChat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Pruteanu\InterChat\Classes\InterChat;
use Pruteanu\InterChat\Http\Requests\ReplyRequest;
use Pruteanu\InterChat\Models\Chat;
use Pruteanu\InterChat\Transformers\ChatReplyTransformer;
use Pruteanu\InterChat\Transformers\ChatTransformer;

class ChatReplyController
{
    public function store(ReplyRequest $request, $chat)
    {
        $chat = Chat::findOrFail($chat);

        return response()->json(fractal($chat, new ChatTransformer($request))->parseIncludes('replies'), Response::HTTP_CREATED);
    }

    public function listReplies($chat, Request $request)
    {
        $chat = Chat::whereUuid($chat)->first();

        $replies =
            $chat->replies()->orderBy('created_at', 'DESC')->paginate($request->get('per_page'));

        return response()->json(fractal($replies, new ChatReplyTransformer($request)), Response::HTTP_OK);
    }
}
