<?php

namespace Tests\Feature;

use App\Enums\EnTodoStatus;
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
        $this->actingAs($user)->get(route('todo-lists'))->assertStatus(200);
    }

    public function test_logged_user_can_create_todo_vue()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->json('POST', route('todos.store'), [
            'title' => 'Test Todo 1',
            'desc' => 'text desc',
        ]);

        $this->assertDatabaseHas('todo_lists', [
            'user_id' => $user->id,
            'title' => 'Test Todo 1',
            'desc' => 'text desc',
        ]);
    }

    public function test_logged_user_can_update_status_todo()
    {
        $user = User::factory()->create();

        $todo = TodoList::factory()->create([
            'user_id' => $user->id,
            'title' => 'Test Todo Can Update'
        ]);

        $todo->updateTodoByStatus($todo->id, EnTodoStatus::IN_PROGRESS);

        $this->actingAs($user)->getJson(route('todos.show', $todo->id))
            ->assertSeeText('IN PROGRESS')
            ->assertOk();
    }

    public function test_logged_user_can_delete_todo()
    {
        $user = User::factory()->create();

        $todo = TodoList::factory()->create([
            'user_id' => $user->id,
        ]);

        $todo->destroy($todo->id);

        $this->actingAs($user)->assertDatabaseMissing('todo_lists', [
            'id' => $todo->id,
        ]);
    }
}
