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
<<<<<<< HEAD
/**
 * Stores a new process flow.
 */
=======
>>>>>>> e5b15c5 (update processflow with or without steps)
Route::middleware(['auth:sanctum'])->group(function () {
    // Route::post('processflows', [ProcessFlowController::class, 'store']);

    // Route::get('processflows/:id', [ProcessFlowController::class, 'show']);

    Route::post('/processflows', [ProcessFlowController::class, 'store']);
    Route::get('/processflows/{id}', [ProcessFlowController::class, 'show']);
    Route::put('/processflows/{id}', [ProcessFlowController::class, 'update']);
<<<<<<< HEAD
=======
    Route::delete('/processflows/{id}', [ProcessFlowController::class, 'destroy']);

    Route::post('workflowhistory', [WorkflowHistoryController::class, 'store']);
    Route::post('processflowstep/create/{id}', [ProcessflowStepController::class, 'store']);
    Route::delete('processflowstep/delete/{id}', [ProcessflowStepController::class, 'destroy']);
    Route::put('processflowstep/update/{id}', [ProcessflowStepController::class, 'update']);
    Route::get('processflowstep/view/{id}', [ProcessflowStepController::class, 'show']);
    Route::post('/processflows', [ProcessFlowController::class, 'store']);
    Route::get('/processflows/{id}', [ProcessFlowController::class, 'show']);
    Route::put('/processflows/{id}', [ProcessFlowController::class, 'update']);
>>>>>>> 3edf406 (first code draft)

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('workflowhistory', [WorkflowHistoryController::class, 'store']);
});
