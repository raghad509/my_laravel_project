<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunityMessageController;
use App\Http\Controllers\DailyNoteController;
use App\Http\Controllers\DietAndHabitController;
use App\Http\Controllers\EducationalResourceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PhobiaController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\RelaxationExerciseController;
use App\Http\Controllers\SpecialistCommunicationController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
// Route::middleware('auth:sanctum')->resource('users', UserController::class);


Route::resource('daily_notes', DailyNoteController::class);
Route::resource('community_messages', CommunityMessageController::class);
Route::apiResource('users',UserController::class);
Route::apiResource('tips',TipController::class);
Route::apiResource('educational_resources',EducationalResourceController::class);
Route::apiResource('questionnaires',QuestionnaireController::class);
Route::apiResource('specilalist_communications',SpecialistCommunicationController::class);

Route::apiResource('notifications',NotificationController::class);
Route::apiResource('diet_and_habits',DietAndHabitController::class);
Route::apiResource('relaxation_exercises',RelaxationExerciseController::class);
Route::apiResource('phobias',PhobiaController::class);
