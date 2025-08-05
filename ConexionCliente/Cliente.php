<?php
class Cliente {
    private $idCliente;
    private $nombre;
    private $apellido;
    private $cuil;
    private $email;
    private $fechaRegistro;
    private $fechaActualizacion;

    public function __construct($nombre, $apellido, $cuil, $email, $idCliente = null) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cuil = $cuil;
        $this->email = $email;
        $this->idCliente = $idCliente;
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getCuil() {
        return $this->cuil;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    public function getFechaActualizacion() {
        return $this->fechaActualizacion;
    }
}
?>
