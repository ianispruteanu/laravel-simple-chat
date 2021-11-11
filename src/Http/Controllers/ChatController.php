<?php

namespace Pruteanu\InterChat\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Pruteanu\InterChat\Models\Chat;
use Pruteanu\InterChat\Transformers\ChatTransformer;

class ChatController
{
    public function openChatWith($userUid): JsonResponse
    {
        $answerer = User::whereUuid($userUid)->first();

        $chat = auth()->user()->openChatWith($answerer);

        return response()->json(fractal($chat, new ChatTransformer()), Response::HTTP_CREATED);
    }

    public function show($chat, Request $request): JsonResponse
    {
        $chat = Chat::whereUuid($chat)->firstOrFail();

        return response()->json(fractal($chat, new ChatTransformer($request))->parseIncludes('replies'), Response::HTTP_OK);
    }

    public function index(): JsonResponse
    {
        return response()->json(fractal(auth()->user()->chats, new ChatTransformer()), Response::HTTP_OK);
    }
}
