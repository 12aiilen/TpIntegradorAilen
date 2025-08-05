<?php
require_once("Direccion.php");

class DireccionDAL {
    private function conectar() {
        return mysqli_connect("localhost", "root", "00001", "cliente");
    }

    public function insertarDireccion(Direccion $dir) {
        $con = $this->conectar();
        $query = sprintf(
            "INSERT INTO direccionescliente (idCliente, calle, numero, piso, dpto, ciudad, provincia, cp, tipoDireccion) 
             VALUES (%d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
            $dir->getIdCliente(),
            mysqli_real_escape_string($con, $dir->getCalle()),
            mysqli_real_escape_string($con, $dir->getNumero()),
            mysqli_real_escape_string($con, $dir->getPiso()),
            mysqli_real_escape_string($con, $dir->getDpto()),
            mysqli_real_escape_string($con, $dir->getCiudad()),
            mysqli_real_escape_string($con, $dir->getProvincia()),
            mysqli_real_escape_string($con, $dir->getCp()),
            mysqli_real_escape_string($con, $dir->getTipo())
        );
        mysqli_query($con, $query);
        mysqli_close($con);
    }

    public function obtenerDireccionesPorCliente($idCliente) {
        $con = $this->conectar();
        $result = mysqli_query($con, "SELECT * FROM direccionescliente WHERE idCliente = $idCliente");
        $direcciones = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $direcciones[] = $row;
        }
        mysqli_close($con);
        return $direcciones;
    }
}
