<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioPedidoController extends Controller
{
    // 1. Inserta al menos 5 registros en las tablas de usuarios y pedidos
    public function insertarDatos()
    {
        // Crear usuarios
        $u1 = Usuario::create(['nombre' => 'Roberto', 'correo' => 'rob@gmail.com', 'telefono' => '123456']);
        $u2 = Usuario::create(['nombre' => 'Ricardo', 'correo' => 'ric@gmail.com', 'telefono' => '456789']);
        $u3 = Usuario::create(['nombre' => 'Ana', 'correo' => 'ana@gmail.com', 'telefono' => '789123']);
        $u4 = Usuario::create(['nombre' => 'Luis', 'correo' => 'luis@gmail.com', 'telefono' => '789321']);
        $u5 = Usuario::create(['nombre' => 'Carlos', 'correo' => 'car@gmail.com', 'telefono' => '654321']);

        // Crear pedidos
        Pedido::create(['producto' => 'Laptop', 'cantidad' => 1, 'total' => 200, 'id_usuario' => $u2->id]);
        Pedido::create(['producto' => 'Mouse', 'cantidad' => 3, 'total' => 45, 'id_usuario' => $u2->id]);
        Pedido::create(['producto' => 'Monitor', 'cantidad' => 2, 'total' => 300, 'id_usuario' => $u5->id]);
        Pedido::create(['producto' => 'Teclado', 'cantidad' => 1, 'total' => 120, 'id_usuario' => $u1->id]);
        Pedido::create(['producto' => 'Silla', 'cantidad' => 1, 'total' => 80, 'id_usuario' => $u3->id]);

        return response()->json(['message' => 'Datos insertados correctamente']);
    }

    // 2. Recupera todos los pedidos asociados al usuario con ID 2
    public function pedidosUsuario2()
    {
        $pedidos = Pedido::where('id_usuario', 2)->get();
        return response()->json($pedidos);
    }

    // 3. Información detallada de pedidos incluyendo nombre y correo del usuario
    public function pedidosConUsuario()
    {
        $pedidos = Pedido::join('usuarios', 'usuarios.id', '=', 'pedidos.id_usuario')
            ->select('pedidos.*', 'usuarios.nombre', 'usuarios.correo')
            ->get();

        return response()->json($pedidos);
    }

    // 4. Pedidos con total entre $100 y $250
    public function pedidosEnRango()
    {
        $pedidos = Pedido::whereBetween('total', [100, 250])->get();
        return response()->json($pedidos);
    }

    // 5. Usuarios cuyos nombres comienzan con "R"
    public function usuariosConR()
    {
        $usuarios = Usuario::where('nombre', 'like', 'R%')->get();
        return response()->json($usuarios);
    }

    // 6. Total de pedidos del usuario con ID 5
    public function totalPedidosUsuario5()
    {
        $total = Pedido::where('id_usuario', 5)->count();
        return response()->json(['total_pedidos_usuario_5' => $total]);
    }

    // 7. Todos los pedidos con info de usuario, ordenados por total descendente
    public function pedidosOrdenados()
    {
        $pedidos = Pedido::join('usuarios', 'usuarios.id', '=', 'pedidos.id_usuario')
            ->select('pedidos.*', 'usuarios.nombre', 'usuarios.correo')
            ->orderBy('pedidos.total', 'desc')
            ->get();

        return response()->json($pedidos);
    }

    // 8. Suma total del campo "total" en la tabla pedidos
    public function sumaTotales()
    {
        $suma = Pedido::sum('total');
        return response()->json(['suma_total_pedidos' => $suma]);
    }

    // 9. Pedido más económico con nombre de usuario
    public function pedidoMasBarato()
    {
        $pedido = Pedido::join('usuarios', 'usuarios.id', '=', 'pedidos.id_usuario')
            ->select('pedidos.*', 'usuarios.nombre')
            ->orderBy('pedidos.total', 'asc')
            ->first();

        return response()->json($pedido);
    }

    // 10. Agrupar por usuario: producto, cantidad y total de cada pedido
    public function pedidosAgrupadosPorUsuario()
    {
        $datos = Pedido::join('usuarios', 'usuarios.id', '=', 'pedidos.id_usuario')
            ->select('usuarios.nombre', 'pedidos.producto', 'pedidos.cantidad', 'pedidos.total')
            ->orderBy('usuarios.nombre')
            ->get();

        return response()->json($datos);
    }
}

