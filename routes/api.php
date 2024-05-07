<?php

use App\Http\Controllers\ProcessFlowController;
use App\Http\Controllers\ProcessflowStepController;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\WorkflowHistoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

/**
 * Stores a new process flow.
 */
// Route::middleware(['auth:sanctum'])->group(function () {
// Route::post('processflows', [ProcessFlowController::class, 'store']);
// Route::middleware(['auth:sanctum'])->group(function () {
// Route::post('processflows', [ProcessFlowController::class, 'store']);
Route::middleware(['auth:sanctum'])->group(function () {
    // Route::post('processflows', [ProcessFlowController::class, 'store']);

    // Route::get('processflows/:id', [ProcessFlowController::class, 'show']);

    Route::post('/processflows', [ProcessFlowController::class, 'store']);
    Route::get('/processflows/{id}', [ProcessFlowController::class, 'show']);
    Route::put('/processflows/{id}', [ProcessFlowController::class, 'update']);
    Route::delete('/processflows/{id}', [ProcessFlowController::class, 'destroy']);

    Route::post('/workflowhistory/create', [WorkflowHistoryController::class, 'store']);
    Route::get('/workflowhistory', [WorkflowHistoryController::class, 'index']);
    Route::put('/workflowhistory/{id}', [WorkflowHistoryController::class, 'update']);

    Route::post('processflowstep/create/{id}', [ProcessflowStepController::class, 'store']);
    Route::delete('processflowstep/delete/{id}', [ProcessflowStepController::class, 'destroy']);
    Route::put('processflowstep/update/{id}', [ProcessflowStepController::class, 'update']);
    Route::get('processflowstep/view/{id}', [ProcessflowStepController::class, 'show']);
    Route::post('/processflows', [ProcessFlowController::class, 'store']);
    Route::get('/processflows/{id}', [ProcessFlowController::class, 'show']);
    Route::put('/processflows/{id}', [ProcessFlowController::class, 'update']);

    Route::post('/route/create', [RoutesController::class, 'store']);
    Route::get('/route', [RoutesController::class, 'index']);
    Route::get('/route/view/{id}', [RoutesController::class, 'show']);
    Route::put('/route/update/{id}', [RoutesController::class, 'update']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
