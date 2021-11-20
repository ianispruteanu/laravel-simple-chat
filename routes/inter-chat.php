<?php
use Illuminate\Support\Facades\Route;

Route::middleware(config('inter-chat.middlewares'))->prefix(config('inter-chat.prefix'))->group(function () {
    Route::get('chat', [\Pruteanu\InterChat\Http\Controllers\ChatController::class, 'index'])->name('chat.list');
    Route::post('chat', [\Pruteanu\InterChat\Http\Controllers\ChatController::class, 'create'])->name('chat.open');
    Route::get('chat/{id}', [\Pruteanu\InterChat\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    Route::get('chat/{id}/reply', [\Pruteanu\InterChat\Http\Controllers\ChatReplyController::class, 'listReplies'])->name('chat.reply.list');
    Route::post('chat/{id}/reply', [\Pruteanu\InterChat\Http\Controllers\ChatReplyController::class, 'store'])->name('chat.reply');
});
