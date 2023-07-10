<?php
use App\Http\Controllers\AdminController;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function  ($router){

Route::post('/adminregister',[AdminController::class,'adminregister'])->name('adminregister');
Route::post('adminlog',[AdminController::class,'adminlog'])->name('adminlog');
// Route::post('/adminlog',[App\Http\Controllers\AdminController::class,'adminlog'])->name('adminlog');

});


