<?php
use App\Http\Controllers\ProcessFlowController;
use App\Http\Controllers\ProcessflowStepController;
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

<<<<<<< HEAD
/**
 * Stores a new process flow.
 */
// Route::middleware(['auth:sanctum'])->group(function () {
// Route::post('processflows', [ProcessFlowController::class, 'store']);
<<<<<<< HEAD
// Route::middleware(['auth:sanctum'])->group(function () {
// Route::post('processflows', [ProcessFlowController::class, 'store']);
Route::middleware(['auth:sanctum'])->group(function () {
    // Route::post('processflows', [ProcessFlowController::class, 'store']);
=======
>>>>>>> 63b2932 (update observer)
=======
Route::middleware(['auth:sanctum'])->group(function () {
    // Route::post('processflows', [ProcessFlowController::class, 'store']);
>>>>>>> 8462c4e (update processflow with or without steps)

    // Route::get('processflows/:id', [ProcessFlowController::class, 'show']);

<<<<<<< HEAD
<<<<<<< HEAD
    Route::post('/processflows', [ProcessFlowController::class, 'store']);
    Route::get('/processflows/{id}', [ProcessFlowController::class, 'show']);
<<<<<<< HEAD
    Route::put('/processflows/{id}', [ProcessFlowController::class, 'update']);
<<<<<<< HEAD
    Route::delete('/processflows/{id}', [ProcessFlowController::class, 'destroy']);

=======
<<<<<<< HEAD
>>>>>>> caac2f3 (route)
    Route::post('workflowhistory', [WorkflowHistoryController::class, 'store']);
    Route::post('processflowstep/create/{id}', [ProcessflowStepController::class, 'store']);
    Route::delete('processflowstep/delete/{id}', [ProcessflowStepController::class, 'destroy']);
    Route::put('processflowstep/update/{id}', [ProcessflowStepController::class, 'update']);
    Route::get('processflowstep/view/{id}', [ProcessflowStepController::class, 'show']);
    Route::post('/processflows', [ProcessFlowController::class, 'store']);
    Route::get('/processflows/{id}', [ProcessFlowController::class, 'show']);
    Route::put('/processflows/{id}', [ProcessFlowController::class, 'update']);
=======
<<<<<<< HEAD
    Route::post('workflowhistory', [WorkflowHistoryController::class, 'store']);
    Route::post('processflowstep/create/{id}', [ProcessflowStepController::class, 'store']);
>>>>>>> 6ecc84c (wip)
=======
>>>>>>> 7a6950d (route)
<<<<<<< HEAD
>>>>>>> caac2f3 (route)
=======
=======
Route::post('/processflows', [ProcessFlowController::class, 'store']);
Route::get('/processflows/{id}', [ProcessFlowController::class, 'show']);
Route::put('/processflows/{id}', [ProcessFlowController::class, 'update']);
>>>>>>> 63b2932 (update observer)
<<<<<<< HEAD
>>>>>>> 56b5cde (update observer)
=======
=======
    Route::post('/processflows', [ProcessFlowController::class, 'store']);
    Route::get('/processflows/{id}', [ProcessFlowController::class, 'show']);
    Route::put('/processflows/{id}', [ProcessFlowController::class, 'update']);
>>>>>>> 8462c4e (update processflow with or without steps)
>>>>>>> 366a88d (update processflow with or without steps)

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
<<<<<<< HEAD
=======

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('workflowhistory', [WorkflowHistoryController::class, 'store']);
});
>>>>>>> d58c8d8 (method to get all workflow history)
