<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\TaskReceived;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreToDoListRequest;
use App\Http\Requests\UpdateToDoListRequest;
use App\Models\TodoList;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
//        TaskReceived::dispatch();

        return $this->successResponse(['tasks' => TodoList::completed(false)->get()], 'TodoList created successfully.',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreToDoListRequest $request)
    {
        $todoList = TodoList::create($request->all());
        event(new TaskReceived($todoList));
        return $this->successResponse($todoList, 'TodoList created successfully.',);
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
