<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

// Test routes
Route::get('/test', function() {
    return response()->json(['message' => 'GET API works!']);
});

Route::post('/test-post', function() {
    return response()->json(['message' => 'POST API works!', 'data' => request()->all()]);
});

// Simple task route
Route::post('/simple-task', function(Request $request) {
    $task = \App\Models\Task::create([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
    ]);
    return response()->json($task, 201);
});

// Main API routes
Route::apiResource('tasks', TaskController::class);

// Debug route
Route::post('/debug-task', function(Request $request) {
    try {
        \Log::info('Debug task creation', $request->all());

        $task = \App\Models\Task::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json(['success' => true, 'task' => $task]);

    } catch (\Exception $e) {
        \Log::error('Task creation error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});


