<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return $this->successResponse($tasks);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $task = Task::create($request->only(['description', 'status']));
        return $this->successResponse($task, 201);
    }

    public function show(Task $task)
    {
        return $this->successResponse($task);
    }

    public function update(Request $request, Task $task)
    {
        $this->validateRequest($request);

        $task->update($request->only(['description', 'status']));
        return $this->successResponse($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return $this->successResponse(null, 204);
    }

    protected function successResponse($data, $statusCode = 200)
    {
        return response()->json($data, $statusCode, [], JSON_UNESCAPED_UNICODE);
    }

    protected function validateRequest(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'status' => 'required|in:todo,doing,done'
        ]);
    }
}
