<?php

namespace Pruteanu\InterChat\Transformers;

use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;
use Pruteanu\InterChat\Models\Chat;
use Pruteanu\InterChat\Models\ChatReply;

class ChatReplyTransformer extends TransformerAbstract
{
    protected $request;

    public function __construct($request = null)
    {
        if ($request instanceof Request) {
            $this->request = $request;
        }

    }

    public function transform(ChatReply $reply): array
    {
        return [
            'uid'           => $reply->uuid,
            'message'       => $reply->reply,
            'read_at'       => $reply->read_at,
            'created_at'    => $reply->created_at,
            'updated_at'    => $reply->updated_at,
            'is_my_message' => $this->request ? $this->request->user()->id == $reply->author->id : null,
        ];
    }
}
