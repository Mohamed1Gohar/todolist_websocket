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

        $payload = [
            'title' => $this->faker->title,
            'desc' => $this->faker->text,
            'user_id' => $user->id,
            'completed' => fake()->boolean,
            'status' => fake()->randomElement(['HOLD', 'IN PROGRESS', 'COMPLETED', 'CANCELLED'])
        ];

        $this->actingAs($user)->json('post', 'todos', $payload)
            ->assertStatus(ResponseAlias::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'title',
                        'desc',
                        'user_id',
                        'completed',
                        'created_at',
                        'updated_at'
                    ],
                    'message',
                    'status'
                ]
            );
        $this->assertDatabaseHas('todo_lists', $payload);
    }
}
