<?php

use App\Http\Controllers\UsuarioPedidoController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/insertar', [UsuarioPedidoController::class, 'insertarDatos']);
Route::get('/usuario2', [UsuarioPedidoController::class, 'pedidosUsuario2']);
Route::get('/info-pedidos', [UsuarioPedidoController::class, 'pedidosConUsuario']);
Route::get('/rango-pedidos', [UsuarioPedidoController::class, 'pedidosEnRango']);
Route::get('/usuarios-r', [UsuarioPedidoController::class, 'usuariosConR']);
Route::get('/total-usuario5', [UsuarioPedidoController::class, 'totalPedidosUsuario5']);
Route::get('/ordenados', [UsuarioPedidoController::class, 'pedidosOrdenados']);
Route::get('/suma-total', [UsuarioPedidoController::class, 'sumaTotales']);
Route::get('/pedido-barato', [UsuarioPedidoController::class, 'pedidoMasBarato']);
Route::get('/agrupados', [UsuarioPedidoController::class, 'pedidosAgrupadosPorUsuario']);


