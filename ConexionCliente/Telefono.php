<?php
class Telefono {
    private $idCliente;
    private $telefono;
    private $tipo;

    public function __construct($idCliente, $telefono, $tipo = 'móvil') {
        $this->idCliente = $idCliente;
        $this->telefono = $telefono;
        $this->tipo = $tipo;
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getTipo() {
        return $this->tipo;
    }
}

?>