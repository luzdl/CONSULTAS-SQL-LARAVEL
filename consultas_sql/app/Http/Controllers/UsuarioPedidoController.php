<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Pedido;
use Illuminate\Http\Request;

class UsuarioPedidoController extends Controller
{
    // Obtener todos los usuarios
    public function obtenerUsuarios()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    // Obtener todos los pedidos
    public function obtenerPedidos()
    {
        $pedidos = Pedido::all();
        return response()->json($pedidos);
    }

    // Crear un nuevo usuario
    public function crearUsuario(Request $request)
    {
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono
        ]);
        return response()->json($usuario, 201);
    }

    // Crear un nuevo pedido para un usuario
    public function crearPedido(Request $request)
    {
        $pedido = Pedido::create([
            'producto' => $request->producto,
            'cantidad' => $request->cantidad,
            'total' => $request->total,
            'id_usuario' => $request->id_usuario
        ]);
        return response()->json($pedido, 201);
    }

    // Obtener todos los pedidos de un usuario específico
    public function pedidosPorUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);
        $pedidos = $usuario->pedidos; // Relación hasMany
        return response()->json($pedidos);
    }

    // Obtener el total gastado por un usuario en todos sus pedidos
    public function totalGastadoPorUsuario($id)
    {
        $total = Pedido::where('id_usuario', $id)->sum('total');
        return response()->json(['total_gastado' => $total]);
    }
}
