<?php
require_once("Cliente.php");

class ClienteDAL {
    private $usuario = 'root';
    private $contrasena = '00001';
    private $servidor = 'localhost';
    private $basededatos = 'cliente';

    private function conectar() {
        $conexion = mysqli_connect($this->servidor, $this->usuario, $this->contrasena, $this->basededatos);
        if (!$conexion) {
            die("Error de conexión: " . mysqli_connect_error());
        }
        mysqli_set_charset($conexion, 'utf8');
        return $conexion;
    }

    public function insertarCliente(Cliente $cliente) {
        $conexion = $this->conectar();

        $consulta = sprintf(
            "INSERT INTO clientes (nombre, apellido, cuil, email) VALUES ('%s', '%s', '%s', '%s')",
            mysqli_real_escape_string($conexion, $cliente->getNombre()),
            mysqli_real_escape_string($conexion, $cliente->getApellido()),
            mysqli_real_escape_string($conexion, $cliente->getCuil()),
            mysqli_real_escape_string($conexion, $cliente->getEmail())
        );

        mysqli_query($conexion, $consulta);
        mysqli_close($conexion);
    }

public function obtenerClientes() {
    $conexion = $this->conectar();

    $resultado = mysqli_query($conexion, "SELECT * FROM clientes");
    $clientes = [];

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $cliente = new Cliente(
            $fila['nombre'],
            $fila['apellido'],
            $fila['cuil'],
            $fila['email'],
            $fila['idCliente'] // ← ahora sí se carga el ID
        );
        $clientes[] = $cliente;
    }

    mysqli_close($conexion);
    return $clientes;
}

}
?>
