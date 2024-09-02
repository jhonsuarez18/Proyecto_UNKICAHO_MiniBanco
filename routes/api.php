<?php

use Illuminate\Http\Request;
use  App\Http\Controllers\Api\ApiEPDetallePedidoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
/// seccion apis
/// apis pedidos
Route::get('/apipedido', 'EpPedidoController@getPedidoItemsBS');
Route::get('/pedidomontoact/{idped}/{mont}', 'EpPedidoController@updatePedidoSinMonto');

//

Route::apiResource('/appedido', ApiEPDetallePedidoController::class);

Route::post('/apiitmpedido', 'EPDetallePedidoController@store');

Route::post('/apidetpedido', 'EpPedidoController@update');

Route::get('/apiactmontPed', 'EpPedidoController@actMontPed');

Route::get('test',function(){
    return response([1,2,3,4],200);
});
