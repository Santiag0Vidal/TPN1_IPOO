<?php

class Viaje{

    private $codigo;
    private $destino;
    private $cantidad;
    private $pasajeros;
    private $responsable;

    public function __construct($codigo,$destino,$cantidad,$pasajeros,$responsable)
    {
        $this->codigo= $codigo;
        $this->destino= $destino;
        $this->cantidad= $cantidad;
        $this->pasajeros= $pasajeros;
        $this ->responsable= $responsable;
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
    public function getResponsable(){
        return $this-> responsable;
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
    public function setResponsable($responsable){
        $this->pasajeros= $responsable;
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
        return "(".$this->codigo.", ".$this->destino.", ".$this->cantidad.", ".($this->getResponsable())->__toString().", \n ".$this->auxToString().")";
    }

    public function auxToString(){
        $cadena="Pasajeros: \n";
        $indice=count($this->pasajeros);
        if($indice==0){
            $cadena = "No hay pasajeros";
        }else{
            $arreglo=  $this->pasajeros;
            for($i=0;$i<$indice;$i++){
                $cadena= $cadena.($arreglo[$i]-> __toString());
            }
        }
        return $cadena;
    }
}
