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

// Route::get('processflows/:id', [ProcessFlowController::class, 'show']);

<<<<<<< HEAD
    Route::post('/processflows', [ProcessFlowController::class, 'store']);
    Route::get('/processflows/{id}', [ProcessFlowController::class, 'show']);
    Route::put('/processflows/{id}', [ProcessFlowController::class, 'update']);
<<<<<<< HEAD
    Route::post('workflowhistory', [WorkflowHistoryController::class, 'store']);
    Route::post('processflowstep/create/{id}', [ProcessflowStepController::class, 'store']);
    Route::post('/processflows', [ProcessFlowController::class, 'store']);
    Route::get('/processflows/{id}', [ProcessFlowController::class, 'show']);
    Route::put('/processflows/{id}', [ProcessFlowController::class, 'update']);
=======
>>>>>>> 7a6950d (route)
=======
Route::post('/processflows', [ProcessFlowController::class, 'store']);
Route::get('/processflows/{id}', [ProcessFlowController::class, 'show']);
Route::put('/processflows/{id}', [ProcessFlowController::class, 'update']);
>>>>>>> 63b2932 (update observer)

// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('workflowhistory', [WorkflowHistoryController::class, 'store']);
});
