<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'auth:sanctum'])->prefix('api')->group(function () {
    Route::get('chat', [\Pruteanu\InterChat\Http\Controllers\ChatController::class, 'index'])->name('chat.list');
    Route::post('chat/{user_uuid}', [\Pruteanu\InterChat\Http\Controllers\ChatController::class, 'openChatWith'])->name('chat.open');
    Route::get('chat/{uuid}', [\Pruteanu\InterChat\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    Route::get('chat/{uuid}/reply', [\Pruteanu\InterChat\Http\Controllers\ChatReplyController::class, 'listReplies'])->name('chat.reply.list');
    Route::post('chat/{uuid}/reply', [\Pruteanu\InterChat\Http\Controllers\ChatReplyController::class, 'store'])->name('chat.reply');
});
