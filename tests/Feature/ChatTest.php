<?php

namespace Pruteanu\InterChat\Tests;

use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;

class ChatTest extends TestCase
{
    public function testOpenChatWithUser()
    {
        $answerer = User::factory()->create();

        $response = $this->postJson('api/chat', ['answerer' => $answerer->getAttribute('uuid')]);

        dd($response->getContent());
        $response->assertStatus(Response::HTTP_CREATED);


    }
}
