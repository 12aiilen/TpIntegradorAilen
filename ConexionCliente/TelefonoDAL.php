<?php
require_once("Telefono.php");

class TelefonoDAL {
    private function conectar() {
        return mysqli_connect("localhost", "root", "00001", "cliente");
    }

    public function insertarTelefono(Telefono $telefono) {
        $con = $this->conectar();

        $tipo = $telefono->getTipo() ?? 'celular';

        $query = sprintf(
            "INSERT INTO telefonoscliente (idCliente, telefono, tipoTelefono) VALUES (%d, '%s', '%s')",
            $telefono->getIdCliente(),
            mysqli_real_escape_string($con, $telefono->getTelefono()),
            mysqli_real_escape_string($con, $tipo)
        );

        mysqli_query($con, $query);
        mysqli_close($con);
    }

    public function obtenerTelefonosPorCliente($idCliente) {
        $con = $this->conectar();
        $result = mysqli_query($con, "SELECT * FROM telefonoscliente WHERE idCliente = $idCliente");
        $telefonos = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $telefonos[] = $row;
        }
        mysqli_close($con);
        return $telefonos;
    }
}
