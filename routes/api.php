<?php

use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\QuestionController;
use Illuminate\Support\Facades\Route;


Route::get('/questions/next', [QuestionController::class, 'next']);
Route::post('/questions/{question}/check', [QuestionController::class, 'checkAnswer']);
Route::apiResource('subjects', SubjectController::class);
