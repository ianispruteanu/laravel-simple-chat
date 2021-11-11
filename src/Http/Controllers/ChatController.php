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
        $answerer = $this->findModel($userUid, User::class, config('inter-chat.user_table_column'));

        $chat = auth()->user()->openChatWith($answerer);

        return response()->json(fractal($chat, new ChatTransformer()), Response::HTTP_CREATED);
    }

    public function show($chat, Request $request): JsonResponse
    {
        $chat = $this->findModel($chat, Chat::class, config('inter-chat.use_uuid') ? 'uuid' : 'id');

        return response()->json(fractal($chat, new ChatTransformer($request))->parseIncludes('replies'), Response::HTTP_OK);
    }

    public function index(): JsonResponse
    {
        return response()->json(fractal(auth()->user()->chats, new ChatTransformer()), Response::HTTP_OK);
    }

    protected function findModel($id, $model, string $method)
    {
        if ($method === 'uuid') {
            return $model::whereUuid($id)->first();
        }

        return $model::find($id);
    }
}
