<?php

namespace Tests\Feature;

use App\Events\TodoReceived;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class TodoReceivedEventTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function  test_logged_users_can_received_todo_created()
    {
        Event::fake();

        $user = User::factory()->create();
        $todo = $this->actingAs($user)->json('post', route('todos.store'), [
            'title' => 'Test Todo Event',
            'desc' => 'text desc',
        ]);

        // Assert that an event was dispatched...
        $todo = $todo['data'];
        Event::assertDispatched(function (TodoReceived $event) use ($todo) {
            return $event->todo->id === $todo['id'];
        });
    }
}
