<?php

namespace Pruteanu\InterChat\Models;

use App\Models\User;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatReply extends Model
{
    use GeneratesUuid, BindsOnUuid;
    protected $fillable = [
        'reply',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function bootSetup()
    {
        if (config('inter-chat.use_uuid')) {
            $this->casts['uuid'] = EfficientUuid::class;
        }
    }

    public function getRouteKey(): string
    {
        if (config('inter-chat.use_uuid')) {
            return 'uuid';
        } else {
            return 'id';
        }
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
