<?php
class Direccion {
    private $idCliente;
    private $calle;
    private $numero;
    private $piso;
    private $dpto;
    private $ciudad;
    private $provincia;
    private $cp;
    private $tipo;

    public function __construct($idCliente, $calle, $numero, $piso, $dpto, $ciudad, $provincia, $cp, $tipo = 'envío') {
        $this->idCliente = $idCliente;
        $this->calle = $calle;
        $this->numero = $numero;
        $this->piso = $piso;
        $this->dpto = $dpto;
        $this->ciudad = $ciudad;
        $this->provincia = $provincia;
        $this->cp = $cp;
        $this->tipo = $tipo;
    }

    public function getIdCliente() { return $this->idCliente; }
    public function getCalle() { return $this->calle; }
    public function getNumero() { return $this->numero; }
    public function getPiso() { return $this->piso; }
    public function getDpto() { return $this->dpto; }
    public function getCiudad() { return $this->ciudad; }
    public function getProvincia() { return $this->provincia; }
    public function getCp() { return $this->cp; }
    public function getTipo() { return $this->tipo; }
}

?>