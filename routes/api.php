<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\apiController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
route::post('user/login',[apiController::class,'login']);

route::get('allPost',[apiController::class,'post']);
route::get('allCategory',[apiController::class,'category']);
route::post('searchPost',[apiController::class,'searchPost']);
route::post('searchCategory',[apiController::class,'searchCategory']);

route::post('detailPost',[apiController::class,'details']);
route::post('activityLog',[apiController::class,'activityLog']);
