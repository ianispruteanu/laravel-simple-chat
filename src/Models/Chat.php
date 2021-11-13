<?php

namespace Pruteanu\InterChat\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    protected $fillable = [
        'opener_id',
        'answerer_id'
    ];

    public function replies(): HasMany
    {
        return $this->hasMany(ChatReply::class);
    }

    public function answerer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
