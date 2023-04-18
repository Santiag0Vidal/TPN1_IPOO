<?php

class ResponsableV
{

    private $nombre;
    private $apellido;
    private $numEmpleado;
    private $numLicencia;

    public function __construct($nombre, $apellido, $numEmpleado, $numLicencia)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->numEmpleado = $numEmpleado;
        $this->numLicencia = $numLicencia;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellido()
    {
        return $this->apellido;
    }
    public function getNumEmpleado()
    {
        return $this->numEmpleado;
    }
    public function getNumLicencia()
    {
        return $this->numLicencia;
    }
    public function setNombre($nombre)
    {
        return $this->nombre = $nombre;
    }
    public function setApellido($apellido)
    {
        return $this->apellido = $apellido;
    }
    public function setNumEmpleado($numEmpleado)
    {
        return $this->numEmpleado = $numEmpleado;
    }
    public function setNumLicencia($numLicencia)
    {
        return $this->numLicencia = $numLicencia;
    }

    public function __toString()
    {
        return "(" . $this->getNombre() . "," . $this->getApellido() . "," . $this->getNumEmpleado() . "," . $this->getNumLicencia() . ")";
    }
}
