<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Task::all());
    }

    public function store(Request $request): JsonResponse
    {
        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        return response()->json($task, 201);
    }

    public function show(Task $task): JsonResponse
    {
        return response()->json($task);
    }

    public function update(Request $request, Task $task): JsonResponse
    {
        $task->update([
            'title' => $request->input('title', $task->title),
            'description' => $request->input('description', $task->description),
        ]);
        return response()->json($task);
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
