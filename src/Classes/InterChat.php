<?php

namespace Pruteanu\InterChat\Classes;

use Pruteanu\InterChat\Models\Chat;
use Pruteanu\InterChat\Models\ChatReply;

class InterChat
{
    public static function addReply(Chat  $chat, array $reply): ChatReply
    {
        $new = (new ChatReply());
        $new->fill(['reply' => $reply['message']]);
        $new->chat()->associate($chat);
        $new->author()->associate(auth()->user());
        $new->save();

        return $new;
    }
}
