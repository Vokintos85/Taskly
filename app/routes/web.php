<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// API Routes
Route::prefix('api')->group(function () {
    Route::get('/test', function () {
        return response()->json(["message" => "API работает!"]);
    });
    
    Route::apiResource('/tasks', App\Http\Controllers\Api\TaskController::class);
});

// API Routes
Route::prefix('api')->group(function () {
    Route::get('/test', function () {
        return response()->json(["message" => "API работает!"]);
    });
    
    Route::apiResource('/tasks', App\Http\Controllers\Api\TaskController::class);
});

// API Routes
Route::prefix('api')->group(function () {
    Route::get('/test', function () {
        return response()->json(["message" => "API работает!"]);
    });
    
    Route::apiResource('/tasks', App\Http\Controllers\Api\TaskController::class);
});

// API Routes
Route::prefix("api")->group(function () {
    Route::get("/test", function () {
        return response()->json(["message" => "API работает!"]);
    });
    
    Route::apiResource("/tasks", App\Http\Controllers\Api\TaskController::class);
});
