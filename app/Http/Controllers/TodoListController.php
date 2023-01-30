<?php

namespace App\Http\Controllers;

use App\Events\TaskReceived;
use App\Http\Requests\StoreToDoListRequest;
use App\Http\Requests\UpdateToDoListRequest;
use App\Models\TodoList;
use App\Traits\ApiResponser;

class TodoListController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse(['tasks' => TodoList::orderBy('status')->completed(false)->get()], 'TodoList created successfully.',);
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

        event(new TaskReceived($todo));

        return $this->successResponse($todo, 'TodoList created successfully.',);
    }

    public function update(UpdateToDoListRequest $request, $id)
    {
        $todoList = TodoList::updateTaskByStatus($id, $request->status);

        event(new TaskReceived($todoList));

        return $this->successResponse($todoList, 'TodoList updated successfully.',);
    }

    public function destroy($id)
    {
        $todoList = TodoList::find($id);
        if ($todoList) {
            event(new TaskReceived($todoList));
            $todoList->delete();
            return $this->successResponse($todoList, 'TodoList Deleted successfully.',);
        }
        return $this->errorResponse($todoList, 'TodoList Not Found..',403);
    }
}