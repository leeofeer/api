<?php 

	use Illuminate\Support\Facades\Route;

	use App\Http\Controllers\v1\LugaresController;

	Route::apiResource('lugares', LugaresController::class);

 ?>