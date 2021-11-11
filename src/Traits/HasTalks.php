<?php

namespace Pruteanu\InterChat\Traits;

use App\Models\User;
use Pruteanu\InterChat\Models\Chat;

trait HasTalks
{
    public function getChatsAttribute()
    {
        return $this->openings->merge($this->answers);
    }

    public function openings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Chat::class, 'opener_id', config('inter-chat.user_table_identified'));
    }

    public function answers()
    {
        return $this->hasMany(Chat::class, 'answerer_id', config('inter-chat.user_table_identified'));
    }

    public function openChatWith(User $user)
    {
        $chat = $this->openings()->make();

        $chat->answerer()->associate($user);

        $chat->save();

        return $chat;
    }
}
