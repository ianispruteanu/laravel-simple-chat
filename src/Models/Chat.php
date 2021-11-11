<?php

namespace Pruteanu\InterChat\Models;

use App\Models\User;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use GeneratesUuid, BindsOnUuid;

    protected $fillable = [
        'opener_id',
        'answerer_id'
    ];

    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    public function getRouteKey(): string
    {
        return 'uuid';
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ChatReply::class, 'chat_id', 'id');
    }

    public function answerer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
