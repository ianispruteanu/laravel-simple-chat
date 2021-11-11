<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatRepliesTable extends Migration
{
    public function up(): void
    {
        Schema::create('chat_replies', function (Blueprint $table) {
            $table->id();
            $table->efficientUuid('uuid')->index();
            $table->unsignedBigInteger('chat_id')->index();
            $table->unsignedBigInteger('author_id')->index();
            $table->text('reply');
            $table->dateTime('read_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('chat_id')->on('chats')->references('id')->onDelete('cascade');
            $table->foreign('author_id')->on('users')->references('id')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_replies');
    }
}
