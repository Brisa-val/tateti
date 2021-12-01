<?php
include_once("tateti.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Rodriguez, Nicolas. Legajo: FAI-3704. Carrera: Tecnicatura Universitaria en Desarrollo Web. niko.0493@gmail.com. Usuario Github: nicolas-rodrigue */
/* Valdebenito, brisa. Legajo: FAI-3781. Carrera: Tecnicatura Universitaria en Desarrollo Web. brisavaldebenito400@gmail.com . Usuario Github: Brisa-val */ 
/*Saltos¿, Tomas. Legajo: .Carrera: Tecnicatura Universitaria en Desarrollo Web. */

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Explicacion 3- Punto 1
 * Se genera 10 juegos resultados 
 * @return array 
 */
function cargarJuegos()
{
    $juegosEjemplos = [];
    $juegosEjemplos[0] = ["jugadorCruz" => "MARIO", "jugadorCirculo" => "PEDRO", "puntosCruz" => 5, "puntosCirculo" => 0];
    $juegosEjemplos[1] = ["jugadorCruz" => "NICO", "jugadorCirculo" => "BRISA", "puntosCruz" => 1, "puntosCirculo" => 1];
    $juegosEjemplos[2] = ["jugadorCruz" => "ANA", "jugadorCirculo" => "LISA", "puntosCruz" => 1, "puntosCirculo" => 1];
    $juegosEjemplos[3] = ["jugadorCruz" => "BRISA", "jugadorCirculo" => "PEDRO", "puntosCruz" => 3, "puntosCirculo" => 0];
    $juegosEjemplos[4] = ["jugadorCruz" => "BRISA", "jugadorCirculo" => "MAJO", "puntosCruz" => 0, "puntosCirculo" => 1];
    $juegosEjemplos[5] = ["jugadorCruz" => "ANA", "jugadorCirculo" => "BRUNO", "puntosCruz" => 1, "puntosCirculo" => 1];
    $juegosEjemplos[6] = ["jugadorCruz" => "MARIA", "jugadorCirculo" => "NICO", "puntosCruz" => 0, "puntosCirculo" => 3];
    $juegosEjemplos[7] = ["jugadorCruz" => "SEBA", "jugadorCirculo" => "ANA", "puntosCruz" => 1, "puntosCirculo" => 1];
    $juegosEjemplos[8] = ["jugadorCruz" => "TOMY", "jugadorCirculo" => "MARIO", "puntosCruz" => 0, "puntosCirculo" => 1];
    $juegosEjemplos[9] = ["jugadorCruz" => "SEBA", "jugadorCirculo" => "LUIS", "puntosCruz" => 0, "puntosCirculo" => 5];

    return $juegosEjemplos;
}

/** 
 * Explicacion 3- Punto 2
 * Funcion que se encarga de:
 * - Mostrar el menu general del juego.
 * - leer un valor de teclado y verificar si este es un valor valido para el manu.
 * @return int 
 */
function seleccionarOpcion()
{
    // mostrando el menu
    echo "Menú de opciones: \n";
    echo "   1) Jugar al tateti  \n";
    echo "   2) Mostrar un juego \n";
    echo "   3) Mostrar el primer juego ganador  \n";
    echo "   4) Mostrar porcentaje de Juegos ganados \n";
    echo "   5) Mostrar resumen de Jugador\n";
    echo "   6) Mostrar listado de juegos Ordenado por jugador O\n";
    echo "   7) Salir\n";
      // obteniendo un valor valido de las opciones del menu
      $numero = obtenerNumeroValidoMenu();
      return $numero;
}


/**
 * Explicacion 3- Punto 3
 * Obtiene un numero valido entre 1 y 7 para el menu general.
 * @return int
 */
function obtenerNumeroValidoMenu()
{
    $valor = 0;
    $isValid = false;
    //ciclo iteractivo que se repetira hasta que el usuario ingrese un valor valido
    do
    {
        echo "ingrese opcion: ";
        $valor = trim(fgets(STDIN));
        $isNumber = is_numeric($valor);
        if ($isNumber)
        {
            $valor = (int) $valor;
            if ($valor >= 1 && $valor <= 7){
                $isValid = true;
            }else{
                echo "la opcion a elegir debe estar ser entre 1 y 7 inclusive .\n";
            }
        }else{
            echo "El valor ingresado no es un numero .\n";
        }
    } while ($isValid);
    return $valor;
}

/**
 * Explicacion 3- Punto 4
 * - Se imprime por pantalla los datos de un juego
 * @param $juegos: array
 * @param $juegoIndice : int
 * @return void
 */
function datosDelJuego($juegos, $juegoIndice)
{
    $resultado = "";
    if ($juegos[$juegoIndice]["puntosCruz"] > $juegos[$juegoIndice]["puntosCirculo"]) {
        $resultado = "GANO X";
    } elseif ($juegos[$juegoIndice]["puntosCirculo"] > $juegos[$juegoIndice]["puntosCruz"]) {
        $resultado = "GANO Y";
    } else {
        $resultado = "EMPATE";
    }

    echo "***************************\n";
    echo "Juego TATETI: " . $juegoIndice . "(" . $resultado . ")\n";
    echo "Jugador X: " . $juegos[$juegoIndice]["jugadorCruz"] . " obtuvo " . $juegos[$juegoIndice]["puntosCruz"] . " puntos\n";
    echo "Jugador O: " . $juegos[$juegoIndice]["jugadorCirculo"] . " obtuvo " . $juegos[$juegoIndice]["puntosCirculo"] . " puntos\n";
    echo "***************************\n";
}

/**
 * Explicacion 3- Punto 5
 * - Funcion que tiene como entrada colección de juegos y un juego
 * - Retorna la colección modificada
 * @param array $coleccionJuegos
* @param array $juego 
* @return array
*/

function agregarJuego($coleccionJuegos,$juego)
{  
    $ultimoDato = count($coleccionJuegos);
    $coleccionJuegos [$ultimoDato] = $juego;

    return $coleccionJuegos;
}

/** modulo que Dada una coleccion de juegos y nombre de un jugador, retorna el indice
 * del primer juego ganado, caso contrario, retorna -1
 * @param array $conjuntoDeJuegos
 * @param array $nombreJugador
 * @return int
 *
 */
function indicePrimerJuegoGanado($conjuntoDeJuegos, $nombreJugador)
{
    $indice = -1;
    $cantColJuegos = count($conjuntoDeJuegos);
    $i = 0;
    $encontro = FALSE;
    while ($i < $cantColJuegos && !$encontro) {
        if ($conjuntoDeJuegos[$i]["jugadorCruz"] == $nombreJugador) {
            if ($conjuntoDeJuegos[$i]["puntosCruz"] > $conjuntoDeJuegos[$i]["puntosCirculo"]) {
                $encontro = true;
                $indice = $i;
            }
        } elseif ($conjuntoDeJuegos[$i]["jugadorCirculo"] == $nombreJugador) {
            if ($conjuntoDeJuegos[$i]["puntosCirculo"] > $conjuntoDeJuegos[$i]["puntosCruz"]) {
                $encontro = true;
                $indice = $i;
            }
        }
        $i++;
    }
    return $indice;
}

/**
 * punto 6 
 * Módulo verificador que busca un jugador por el nombre ingresado en la colección de juegos, en caso de estar retorna 1, en caso de no retorna -1
 * @param array $colJuegos
 * @param string $jugadorNombre
 * @return int
 */
function jugadorJugoConNombre($colJuegos, $jugadorNombre) {
    $cantidadJuegos = count($colJuegos);
    $jugadorEncontrado = -1;
    for ($x=0; $x < $cantidadJuegos; $x++) {
        if ($colJuegos[$x]["jugadorCruz"] == $jugadorNombre || $colJuegos[$x]["jugadorCirculo"] == $jugadorNombre) {
            $jugadorEncontrado = 1;
        }
    }
    return($jugadorEncontrado);
}
 
/**
 * EXPLICACION 3- Punto 7
 * -Dada una coleccion de juegos y el nombre de un jugador
 * -Retorna el resumen
 * @param array $listadoJuegos
 * @param array $nombreDelJugador
 * @return array
 *
 */
function resumenJugador($listadoJuegos, $nombreDelJugador)
{
    $resumen = [
        "nombre" => "",
        "juegosGanados" => 0,
        "juegosPerdidos" => 0,
        "juegosEmpatados" => 0,
        "puntosAcumulados" => 0
    ];
    $auxNombre = "";
    $auxJuegosGanados = 0;
    $auxJuegosPerdidos = 0;
    $auxJuegosEmpatados = 0;
    $auxPuntosAcumulados = 0;
    $cantColeccionJuegos = count($listadoJuegos);
 
    for ($j = 0; $j < $cantColeccionJuegos; $j++) {
        if ($listadoJuegos[$j]["jugadorCruz"] == $nombreDelJugador) {
            $auxNombre = $nombreDelJugador;
            if ($listadoJuegos[$j]["puntosCruz"] > $listadoJuegos[$j]["puntosCirculo"]) {
                $auxJuegosGanados = $auxJuegosGanados + 1;
                $auxPuntosAcumulados = $auxPuntosAcumulados + $listadoJuegos[$j]["puntosCruz"];
            }
            if ($listadoJuegos[$j]["puntosCruz"] < $listadoJuegos[$j]["puntosCirculo"]) {
                $auxJuegosPerdidos = $auxJuegosPerdidos + 1;
            }
            if ($listadoJuegos[$j]["puntosCruz"] == $listadoJuegos[$j]["puntosCirculo"]) {
                $auxJuegosEmpatados = $auxJuegosEmpatados + 1;
                $auxPuntosAcumulados = $auxPuntosAcumulados + $listadoJuegos[$j]["puntosCruz"];
            }
        }
 
        if ($listadoJuegos[$j]["jugadorCirculo"] == $nombreDelJugador) {
            $auxNombre = $nombreDelJugador;
 
            if ($listadoJuegos[$j]["puntosCruz"] < $listadoJuegos[$j]["puntosCirculo"]) {
                $auxJuegosGanados = $auxJuegosGanados + 1;
                $auxPuntosAcumulados = $auxPuntosAcumulados + $listadoJuegos[$j]["puntosCirculo"];
            }
            if ($listadoJuegos[$j]["puntosCruz"] > $listadoJuegos[$j]["puntosCirculo"]) {
                $auxJuegosPerdidos = $auxJuegosPerdidos + 1;
            }
            if ($listadoJuegos[$j]["puntosCruz"] == $listadoJuegos[$j]["puntosCirculo"]) {
                $auxJuegosEmpatados = $auxJuegosEmpatados + 1;
                $auxPuntosAcumulados = $auxPuntosAcumulados + $listadoJuegos[$j]["puntosCirculo"];
            }
        }
    }
 
    $resumen["nombre"] = $auxNombre;
    $resumen["juegosGanados"] = $auxJuegosGanados;
    $resumen["juegosPerdidos"] = $auxJuegosPerdidos;
    $resumen["juegosEmpatados"] = $auxJuegosEmpatados;
    $resumen["puntosAcumulados"] = $auxPuntosAcumulados;

    echo "****************************** \n";
    echo "Jugador: ".$resumen["nombre"]."\n";
    echo "Ganó: ".$resumen["juegosGanados"]." juegos \n";
    echo "Perdió: ".$resumen["juegosPerdidos"]." juegos \n";
    echo "Empató: ".$resumen["juegosEmpatados"]." juegos \n";
    echo "Total de puntos acumulados: ".$resumen["puntosAcumulados"]." puntos \n";
    echo "****************************** \n";
 
    return $resumen;
}

/**
 * EXPLICACION 3- Punto 8
 * Funcion que solicita al usuario el símbolo X o O y en caso correcto lo retorna
 * @return string
 */
 
function validarSimbolo()
{
    do {
        echo "Ingrese un símbolo X o O: ";
        $simboloValidar = strtoupper(trim(fgets(STDIN)));
        if ($simboloValidar != "X" && $simboloValidar != "O") {
            echo "Símbolo inválido\n";
        }
    } while ($simboloValidar != "X" && $simboloValidar != "O");
    return ($simboloValidar);
}
/**
 * EXPLICACION 3- Punto 9
 * -Funcion que recibe una colección de juegos y retorna la cantidad de juegos ganados
 * @param array $colecJuegos
 * @return int
 */
 
function juegosGanados($colecJuegos)
{
    $cantidadDeJuegosGanadosTotales = 0;
    for ($k = 0; $k < count($colecJuegos); $k++) {
        if ($colecJuegos[$k]["puntosCruz"] != 1) {
            $cantidadDeJuegosGanadosTotales++;
        }
    }
    return ($cantidadDeJuegosGanadosTotales);
}

 /**
 * Módulo que recibe una colección de juegos y un símbolo y retorna la cantidad de juegos ganados de ese símbolo ~ 10
 * @param array $colecDeJuegos
 * @param string $simbolo
 * @return int
 */
 
function simboloJuegosGanados($colecDeJuegos, $simbolo)
{
    $cantidadDeJuegosGanadosSimbolo = 0;
    for ($z = 0; $z < count($colecDeJuegos); $z++) {
        if ($simbolo == "X") {
            if ($colecDeJuegos[$z]["puntosCruz"] > 1) {
                $cantidadDeJuegosGanadosSimbolo++;
            }
        } else {
            if ($colecDeJuegos[$z]["puntosCirculo"] > 1) {
                $cantidadDeJuegosGanadosSimbolo++;
            }
        }
    }
    return ($cantidadDeJuegosGanadosSimbolo);
}

 /**
 * Explicacion 3- Punto 11
 * 
 * @param array $coleccion
 */
function ordenarJugadorO($coleccion){
    
    uasort($coleccion, function($a,$b){
        return strnatcmp($a["jugadorCirculo"], $b["jugadorCirculo"]);
    });
    print_r($coleccion);
}

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
// int $respuesta, juegoABuscar, jugadorEnPartidas, indiceDelPrimerJuegoGanado, cantJuegosGanados, cantTotalDeJuegos, jugadorExiste
// float $porcentaje
// ARRAY nuevoJuego, juegosCargados
// STRING nombreJugadorABuscar, simbolo, nombre

//Inicialización de variables:
$juegosCargados= cargarJuegos();

//Proceso:
$pepito = obtenerNumeroValidoMenu();
if ($pepito == true) {
    do {
        $respuesta = seleccionarOpcion();
        switch ($respuesta) {
            case 1:
                $juegar = jugar();
                $juegosCargados = agregarJuego($juegosCargados, $jugar);
                break;
            case 2:
                $buscarJuego = obtenerNumeroValidoMenu();
                datosDelJuego($juegosCargados, ($buscarJuego - 1));
                break;
            case 3:
                echo "Ingrese el nombre del jugador a buscar: ";
                $buscarJugador = trim(fgets(STDIN));
                $jugadorEnPartidas = jugadorJugoConNombre($juegosCargados, strtoupper($buscarJugador));
                if ($jugadorEnPartidas == 1) {
                    $primerJuegoGanado = indicePrimerJuegoGanado($juegosCargados, strtoupper($nombreJugadorABuscar));
                    if ($primerJuegoGanado == -1) {
                        echo "El jugador " . $buscarJugador . " no ganó ningún juego\n";
                    }else {
                        datosDelJuego($juegosCargados, $primerJuegoGanado);
                    }
                }else {
                    echo "El jugador " . $buscarJugador . " no participó de ningún juego\n";
                }
            
                break;
            case 4:
                $simbolo=validarSimbolo();
                $juegosGanados=simboloJuegosGanados($juegosCargados,$simbolo);
                $totalDeJuegos=juegosGanados($juegosCargados);
                $porcentaje=($juegosGanados/$totalDeJuegos)*100;
                echo $simbolo." ganó el ".$porcentaje."% de juegos ganados.\n";
                break;
            case 5:
                echo "Ingrese el nombre de un jugador: ";
                $nombre = trim(fgets(STDIN));
                $jugadorExiste = jugadorJugoConNombre($juegosCargados, strtoupper($nombre));
    
                if ($jugadorExiste == 1) {
                    resumenJugador($juegosCargados, strtoupper($nombre));
                }else {
                    echo "El jugador ". $nombre . " no jugó ninguna partida.\n";
                }
                break;
            case 6:
                ordenarJugadorO($juegosCargados);
                break;
            case 7:
                echo "

                █▀▀ █▄░█ █▀▄ . ▄▀▀▄ █▀▀ . ▄▀▀ ▄▀▄ ██▄██ █▀▀
                █▀▀ █▀██ █░█ . █░░█ █▀▀ . █░█ █▄█ █░▀░█ █▀▀
                ▀▀▀ ▀░░▀ ▀▀░ . ░▀▀░ ▀░░ . ░▀▀ ▀░▀ ▀░░░▀ ▀▀▀
                ";
                break;
        };
    } while ($respuesta = obtenerNumeroValidoMenu());
}
