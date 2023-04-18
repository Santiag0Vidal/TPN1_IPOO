<?php

class Pasajero
{
    private $nombre;
    private $apellido;
    private $numDocumento;
    private $telefono;

    public function __construct($nombre, $apellido, $numDocumento, $telefono)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->numDocumento = $numDocumento;
        $this->telefono = $telefono;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellido()
    {
        return $this->apellido;
    }
    public function getNumDocumento()
    {
        return $this->numDocumento;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function setNombre($nombre)
    {
        return $this->nombre = $nombre;
    }
    public function setApellido($apellido)
    {
        return $this->apellido = $apellido;
    }
    public function setNumDocumento($numDocumento)
    {
        return $this->numDocumento = $numDocumento;
    }
    public function setTelefono($telefono)
    {
        return $this->telefono = $telefono;
    }

    public function __toString()
    {
        return "(" . $this->getNombre() . "," . $this->getApellido() . "," . $this->getNumDocumento() . "," . $this->getTelefono() . ")\n";
    }
}
