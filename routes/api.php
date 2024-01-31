<?php
use App\Http\Controllers\ProcessFlowController;
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

Route::middleware(['auth:sanctum'])->group(function () {
    // Route::post('processflows', [ProcessFlowController::class, 'store']);

    // Route::get('processflows/:id', [ProcessFlowController::class, 'show']);

    Route::post('/processflows', [ProcessFlowController::class, 'store']);
    Route::get('/processflows/{id}', [ProcessFlowController::class, 'show']);
    Route::put('/processflows/{id}', [ProcessFlowController::class, 'update']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
