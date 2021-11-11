<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            if (config('inter-chat.use_uuid')) {
                $table->efficientUuid('uuid')->index();
            }

            $table->unsignedBigInteger('opener_id')->index();
            $table->unsignedBigInteger('answerer_id')->index();
            $table->timestamps();

            $table->foreign('opener_id')->on('users')->references('id');
            $table->foreign('answerer_id')->on('users')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
}
