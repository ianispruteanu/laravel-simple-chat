<?php

namespace Pruteanu\InterChat\Transformers;

use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;
use Pruteanu\InterChat\Models\Chat;

class ChatTransformer extends TransformerAbstract
{
    protected $request;

    public function __construct($request = null)
    {
        if ($request instanceof Request) {
            $this->request = $request;
        }
    }

    protected $availableIncludes = [
        'replies'
    ];

    public function includeReplies(Chat $chat)
    {
        return $this->collection(
            $chat->replies()
                ->orderBy('created_at', 'DESC')
                ->paginate(20), new ChatReplyTransformer($this->request));
    }

    public function transform(Chat $chat): array
    {
        $id = $chat->id;

        $id = config('inter-chat.use_uuid') ?? $chat->uuid;

        return [
            'id'            => $id,
            'created_at' => $chat->created_at,
            'updated_at' => $chat->updated_at,
        ];
    }
}
