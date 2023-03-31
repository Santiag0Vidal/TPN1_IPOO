<?php

class Viaje{

    private $codigo;
    private $destino;
    private $cantidad;
    private $pasajeros;

    public function __construct($codigo,$destino,$cantidad,$pasajeros)
    {
        $this->codigo= $codigo;
        $this->destino= $destino;
        $this->cantidad= $cantidad;
        $this->pasajeros= $pasajeros;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function getDestino(){
        return $this->destino;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function getPasajeros(){
        return $this-> pasajeros;
    }

    public function setCodigo($codigo){
        $this->codigo= $codigo;
    }

    public function setDestino($destino){
        $this->destino= $destino;
    }

    public function setCantidad($cantidad){
        $this->cantidad= $cantidad;
    }

    public function setPasajeros($pasajeros){
        $this->pasajeros= $pasajeros;
    }

    /**
     * Agrega un nuevo pasajero al arreglo
     * @param Array Un arreglo asociativo
     * @return Boolean Retorna verdadero si queda espacio en el arreglo y retorna falso si no queda espacio en el arreglo
     */

    public function agregarPasajero($pasajero){
        $continuar = false;
        $indice=count($this->pasajeros);
        if($this->cantidad > $indice){
            $this->pasajeros[$indice]= $pasajero;
            $band =true;
        }
        return $continuar;
    }
    public function __toString()
    {
        return "(".$this->codigo.", ".$this->destino.", ".$this->cantidad.", ".print_r($this->pasajeros).")";
    }
}
