<?php

use App\Http\Controllers\HeroiController;
use App\Http\Controllers\VilaoController;
use Illuminate\Support\Facades\Route;


Route::get('/heroi', [HeroiController::class, 'exibir']);
Route::post('/heroi', [HeroiController::class, 'criar']);
Route::put('/heroi/{id}', [HeroiController::class, 'editar']);
Route::delete('/heroi/{id}', [HeroiController::class, 'excluir']);
Route::get( '/heroi/{id}', [HeroiController::class, 'BuscarPorId']);

Route::get('/vilao', [VilaoController::class, 'exibir']);
Route::post('/vilao', [vilaoController::class, 'criar']);
Route::put('/vilao/{id}', [VilaoController::class, 'editar']);
Route::delete('/vilao/{id}', [VilaoController::class, 'excluir']);
Route::get( '/vilao/{id}', [VilaoController::class, 'BuscarPorId']);

