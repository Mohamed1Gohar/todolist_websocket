<?php

namespace App\Http\Controllers;

use App\Events\TodoReceived;
use App\Http\Requests\StoreToDoListRequest;
use App\Http\Requests\UpdateToDoListRequest;
use App\Models\TodoList;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $todos = $request->user()->todos->groupBy('completed');
        return $this->successResponse(['done' => $todos[boolval(true)] ?? [], 'pending' => $todos[boolval(false)] ?? []], 'TodoList view successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->successResponse(['done' => TodoList::find($id)], 'Show Todo successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreToDoListRequest $request)
    {

        $todo = $request->user()->todos()->create($request->all());

        event(new TodoReceived($todo));

        return $this->successResponse($todo, 'TodoList created successfully.', 201);
    }

    public function update(UpdateToDoListRequest $request, $id)
    {
        $todoList = TodoList::updateTodoByStatus($id, $request->status);

        event(new TodoReceived($todoList));

        return $this->successResponse($todoList, 'TodoList updated successfully.',);
    }

    public function destroy($id)
    {
        $todoList = TodoList::find($id);
        if ($todoList) {
            event(new TodoReceived($todoList));
            $todoList->delete();
            return $this->successResponse($todoList, 'TodoList Deleted successfully.',);
        }
        return $this->errorResponse($todoList, 'TodoList Not Found..',403);
    }
}
