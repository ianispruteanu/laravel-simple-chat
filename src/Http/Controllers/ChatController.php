<?php

namespace Pruteanu\InterChat\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Pruteanu\InterChat\Models\Chat;
use Pruteanu\InterChat\Transformers\ChatTransformer;

class ChatController
{
    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required|exists:users,id'
        ]);


        if ($user = User::where('id', $validator->validated()['user'])->first()) {
            $chat = Chat::where('answerer_id', auth()->user()->id)
                ->where('opener_id', $user->id)->first();

            if (!$chat) {
                $chat = Chat::where('opener_id', auth()->user()->id)
                    ->where('answerer_id', $user->id)->first();
            }
        };

        if (!$chat) {
            $chat = auth()->user()->openChatWith($user);
        }

        return response()->json(fractal($chat, new ChatTransformer()), Response::HTTP_CREATED);
    }

    public function show(Chat $chat, Request $request): JsonResponse
    {
        return response()->json(fractal($chat, new ChatTransformer($request))->parseIncludes($request->get('with')), Response::HTTP_OK);
    }

    public function index(): JsonResponse
    {
        return response()->json(fractal(auth()->user()->chats, new ChatTransformer()), Response::HTTP_OK);
    }
}
