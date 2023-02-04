<?php

namespace Tests\Feature;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class TodosTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_logged_user_can_see_todos_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get('/todo-lists')->assertStatus(200);
    }

    public function test_logged_user_can_create_todo_vue()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->post('todos', [
            'title' => 'Test Todo 1',
            'desc' => 'text desc',
        ]);

        $this->assertDatabaseHas('todo_lists', [
            'user_id' => $user->id,
            'title' => 'Test Todo 1',
            'desc' => 'text desc',
        ]);
    }
}
