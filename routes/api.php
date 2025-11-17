<?php 

	use Illuminate\Support\Facades\Route;

	use App\Http\Controllers\v1\PlacesController;

	Route::apiResource('places', PlacesController::class);

 ?>