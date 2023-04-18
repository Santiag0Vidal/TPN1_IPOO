<?php
include 'Viaje.php';
include 'ResponsableV.php';
include 'Pasajero.php';
$viaje = viajePrecargado();

do {
    $opcion = menuViaje();
    switch ($opcion) {
        case 1:
            $viaje = ingresoViaje();
            break;
        case 2:
            $viaje = modificarPasajero($viaje);
            break;
        case 3:
            echo " " . $viaje->__toString() . "\n";
            break;
        default:
            break;
    };
} while ($opcion != 4);
echo ("adios");

/**
 * Ingreso de un Viaje nuevo
 * @return Viaje
 */
function ingresoViaje()
{
    echo "Ingrese un codigo\n";
    $codigo = trim(fgets(STDIN));

    echo "Ingrese un destino\n";
    $destino = trim(fgets(STDIN));

    do {
        $continuar = true;
        echo "Ingrese una cantidad maxima de pasajeros\n";
        $cantidad = trim(fgets(STDIN));
        if ($cantidad > 0) {
            $continuar = false;
        }
    } while ($continuar);
    $pasajeros = crearPasajeros($cantidad);

    $responsable = crearResponsable();


    return new Viaje($codigo, $destino, $cantidad, $pasajeros, $responsable);
}

/**
 * Menu modificacion pasajero
 * @param Viaje
 * @return Viaje
 */

function modificarPasajero($viaje)
{
    do {
        $opcion = menuModificacion();
        switch ($opcion) {
            case 1:
                echo "Ingrese un codigo\n";
                $codigo = trim(fgets(STDIN));
                $viaje->setCodigo($codigo);
                break;
            case 2:
                echo "Ingrese el destino\n";
                $destino = trim(fgets(STDIN));
                $viaje->setDestino($destino);
                break;
            case 3:
                $viaje = modificarCantidad($viaje);
                break;
            case 4:
                $viaje = modificarPasajeros($viaje);
                break;
            case 5:
                $viaje = modificarResponsable($viaje);
                break;
            default:
                break;
        };
    } while ($opcion != 5);

    return $viaje;
}

/**
 * Modifica la cantidad maxima de pasajeros
 * @param Viaje
 * @param Viaje
 */
function modificarCantidad($viaje)
{
    $minimo = count($viaje->getPasajeros());
    do {
        $continuar = true;
        echo "Ingrese la cantidad maxima de pasajeros\n";
        $cantidad = trim(fgets(STDIN));
        if ($cantidad > 0) {
            if ($cantidad >= $minimo) {
                $continuar = false;
            } else {
                echo "La cantidad debe ser mayor a $minimo\n";
            }
        } else {
            echo "Cantidad invalida\n";
        }
    } while ($continuar);

    $viaje->setCantidad($cantidad);

    return $viaje;
}

/**
 * Metodo para elegir que modificar
 * @param Viaje
 * @return Viaje Retorna el viaje con los pasajeros 
 */
function modificarPasajeros($viaje)
{
    do {
        $opcion = menuPasajeros();
        switch ($opcion) {
            case 1:
                $viaje = agregarPasajero($viaje);
                break;
            case 2:
                $viaje = eliminarPasajero($viaje);
                break;
            default:
                break;
        };
    } while ($opcion != 3);

    return $viaje;
}

/**
 * Agrega un pasajero
 * @param Viaje
 * @return Viaje Retorna un viaje con un pasajero mas
 */
function agregarPasajero($viaje)
{
    $pasajeros = $viaje->getPasajeros();
    $cant = count($pasajeros);
    $cantidad = $viaje->getCantidad();
    if ($cant < $cantidad) {
        $pasajeros[$cant] = crearPasajero($pasajeros);
    }
    $viaje->setPasajeros($pasajeros);

    return $viaje;
}

/**
 * Elimina un pasajero usando el numero de documento
 * @param Viaje 
 * @return Viaje Retorna un viaje con un pasajero eliminado
 */
function eliminarPasajero($viaje)
{
    $pasajeros = $viaje->getPasajeros();
    do {
        $band = true;
        echo "Ingrese el numero de documento\n";
        $numero = trim(fgets(STDIN));
        if ($numero > 0) {
            $id = buscarDocumento($numero, $pasajeros);
            if ($id != -1) {
                $band = false;
            } else {
                echo "Numero de documento no encontrado\n";
            }
        } else {
            echo "Numero de documento invalido\n";
        }
    } while ($band);
    $viajeros = [];
    $lenght = count($pasajeros);
    $ind = 0;
    for ($i = 0; $i < $lenght; $i++) {
        if ($i != $id) {
            $viajeros[$ind] = $pasajeros[$i];
            $ind++;
        }
    }
    $viaje->setPasajeros($viajeros);
    return $viaje;
}

/**
 * Crea un arreglo de pasajeros
 * @param Number Cantidad maxima de pasajeros
 * @return Array Retorna un arreglo de pasajeros
 */
function crearPasajeros($cantidad)
{
    do {
        $band = true;
        echo "Ingrese la cantidad de pasajeros a cargar\n";
        $indice = trim(fgets(STDIN));
        if ($indice >= 0) {
            if ($indice <= $cantidad) {
                $band = false;
            } else {
                echo "La cantidad debe ser menor a $cantidad";
            }
        } else {
            echo "Cantidad invalida";
        }
    } while ($band);
    $pasajeros = [];
    for ($i = 0; $i < $indice; $i++) {
        $pasajeros[$i] = crearPasajero($pasajeros);
    }

    return $pasajeros;
}

/**
 * Crea un pasajero
 * @param Array Arreglo de pasajeros
 * @return Array Retorna un pasajero
 */
function crearPasajero($pasajeros)
{
    echo "Ingrese el nombre\n";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese el apellido\n";
    $apellido = trim(fgets(STDIN));
    do {
        $band = true;
        echo "Ingrese el numero de documento\n";
        $numero = trim(fgets(STDIN));
        if (buscarDocumento($numero, $pasajeros) == -1) {
            $band = false;
        } else {
            echo "Numero de documento invalido";
        }
    } while ($band);
    echo "Ingrese el numero de telefono\n";
    $telefono = trim(fgets(STDIN));
    $pasajero = new Pasajero($nombre, $apellido, $numero, $telefono);
    return $pasajero;
}

//Menu para modificar Pasajeros
function menuPasajeros()
{
    $band = true;
    do {
        echo
        "Presione:  
            1 agregar pasajero
            2 quitar pasajero
            3 para salir\n";
        $opcion =  trim(fgets(STDIN));
        if ($opcion > 0 && $opcion <= 3) {
            $band = false;
        } else {
            echo "Opcion invalida\n";
        }
    } while ($band);
    return $opcion;
}
function menuResponsable(){
    $band= true;
    do{
        echo 
        "Presione:  
        1 cambiar responsable
        2 modificar responsable
        3 ver informacion del responsable
        4 para salir\n";
        $opcion =  trim(fgets(STDIN));
        if($opcion>0 && $opcion<=4){
            $band=false;
        }else{
            echo "Opcion invalida\n";
        }
    }while($band);

    return $opcion;
}

function crearResponsable()
{
    echo "Ingrese el número de empleado\n";
    $numero = trim(fgets(STDIN));
    echo "Ingrese el número de licencia\n";
    $licencia = trim(fgets(STDIN));
    echo "Ingrese el nombre\n";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese el apellido\n";
    $apellido = trim(fgets(STDIN));
    return new ResponsableV($numero, $licencia, $nombre, $apellido);
}

function modificarResponsable($viaje){

    do{
        $opcion= menuResponsable();
        switch($opcion){
            case 1: 
                $responsable=crearResponsable();
                $viaje-> setResponsable($responsable);
                break;
            case 2: 
                $viaje= modResponsable($viaje);
                break;
            case 3:
                $responsable= $viaje->getResponsable();
                echo $responsable-> __toString()."\n";
                break;
            default: 
                break;
            };
    }while($opcion!=4);

    return $viaje;

}

function modResponsable($viaje){
    do{
        $opcion= menuModificarResponsable();
        switch($opcion){
            case 1: 
                $responsable= $viaje-> getResponsable();
                echo"Ingrese el numero de licencia\n";
                $numero= trim(fgets(STDIN));
                $responsable->setLicencia($numero);
                $viaje-> setResponsable($responsable);
                break;
            case 2: 
                $responsable= $viaje-> getResponsable();
                echo"Ingrese el nombre\n";
                $nombre= trim(fgets(STDIN));
                $responsable->setNombre($nombre);
                $viaje-> setResponsable($responsable);
                break;
            case 3:
            $responsable= $viaje-> getResponsable();
            echo"Ingrese el apellido\n";
            $apellido= trim(fgets(STDIN));
            $responsable->setApellido($apellido);
            $viaje-> setResponsable($responsable);
                break;
            default: 
                break;
            };
    }while($opcion!=4);

    return $viaje;
}
function menuModificarResponsable(){
    $band= true;
    do{
        echo 
        "Presione:  
        1 cambiar número de licencia
        2 cambiar nombre
        3 cambiar apellido
        4 para salir\n";
        $opcion =  trim(fgets(STDIN));
        if($opcion>0 && $opcion<=4){
            $band=false;
        }else{
            echo "Opcion invalida\n";
        }
    }while($band);
    return $opcion;
}

//Menu para modificar viajes
function menuModificacion()
{
    $band = true;
    do {
        echo
        "Presione:  
            1 modificar codigo
            2 modificar destino 
            3 modificar cantidad
            4 modificar lista de pasajeros
            5 modificar responsable del viaje
            6 para salir\n";
        $opcion =  trim(fgets(STDIN));
        if ($opcion > 0 && $opcion <= 6) {
            $band = false;
        } else {
            echo "Opcion invalida\n";
        }
    } while ($band);
    return $opcion;
}

//Menu para viaje
function menuViaje()
{
    $band = true;
    do {
        echo
        "Ingrese:  
            1 para ingresar un viaje
            2 para modificar el viaje 
            3 para ver la informacion del viaje
            4 para salir\n";
        $opcion =  trim(fgets(STDIN));
        if ($opcion > 0 && $opcion <= 4) {
            $band = false;
        } else {
            echo "Opcion invalida\n";
        }
    } while ($band);
    return $opcion;
}

function viajePrecargado()
{
    $pasajeros = [];
    //  $pasajeros[0] = ["nombre" => "Nicolas", "apellido" => "Cruz", "nro documento" => 37264859];
    //  $pasajeros[1] = ["nombre" => "Lionel", "apellido" => "Messi", "nro documento" => 42652479];
    //  $pasajeros[2] = ["nombre" => "Victoria", "apellido" => "Hernandes", "nro documento" => 29525857];
    //  $pasajeros[3] = ["nombre" => "Cintia", "apellido" => "Fernandes", "nro documento" => 25874857];
    $pasajeros[0] = new Pasajero("Nicolas", "Cruz", 37264859, 434765765343);
    $pasajeros[1] = new Pasajero("Lionel", "Messi", 42652479, 434354654);
    $pasajeros[2] = new Pasajero("Victoria", "Hernandes", 29525857, 4367574343);
    $pasajeros[3] = new Pasajero("Cintia", "Fernandes", 25874857, 476573434343);
    return new Viaje(1, "Neuquen", 10, $pasajeros, new ResponsableV("Salomon", "Rondon", 321312, 42321321));
}

/**
 * Busca $num en $arr siendo un arreglo de arreglos asociativos y devuelve el indice del elemento donde esta $num
 * o -1 si no lo encuentra
 * @param Double 
 * @param Array Un arreglo de arreglos asociativos
 * @return Number Retorna un indice o -1
 */
function buscarDocumento($num, $arr)
{
    $continuar = true;
    $res = -1;
    $lenght = count($arr);
    $n = 0;
    while ($n < $lenght and $continuar) {
        if (($arr[$n])->getNumDocumento() == $num) {
            $band = false;
            $res = $n;
        }
        $n++;
    }
    return $res;
}
