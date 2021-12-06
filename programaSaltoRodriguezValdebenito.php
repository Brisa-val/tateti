<?php
include_once("tateti.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Saltos, Tomas. Legajo FAI -3635: .Carrera: Tecnicatura Universitaria en Desarrollo Web. correo electronico. tomasagustinsalto@gmail.com usuario Github: tomassalto */
/* Rodriguez, Nicolas. Legajo: FAI-3704. Carrera: Tecnicatura Universitaria en Desarrollo Web. niko.0493@gmail.com. Usuario Github: nicolas-rodrigue */
/* Valdebenito, brisa. Legajo: FAI-3781. Carrera: Tecnicatura Universitaria en Desarrollo Web. brisavaldebenito400@gmail.com . Usuario Github: Brisa-val */ 



/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Explicacion 3- Punto 1
 * - Se genera 10 juegos resultados 
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
 * - Leer un valor de teclado y verificar si este es un valor valido para el manu.
 * @return int 
 */
function seleccionarOpcion()
{
    // mostrando el menu
    echo "MENU DE OPCIONES:\n";
    echo "   1) Jugar al tateti \n";
    echo "   2) Mostrar un juego \n";
    echo "   3) Mostrar el primer juego ganador \n";
    echo "   4) Mostrar porcentaje de Juegos ganados\n";
    echo "   5) Mostrar resumen de Jugador\n";
    echo "   6) Mostrar listado de juegos Ordenado por jugador O\n";
    echo "   7) Salir\n";

    // obteniendo un valor valido de las opciones del menu
    echo "Ingrese opcion: ";
    $num = solicitarNumeroEntre(1, 7);
    return $num;
}

//Explicacion 3- Punto 3
// funcion soliciteNumeroEntre($min,$max) se encuentra en el archivo tateti

/**
 * Explicacion 3- Punto 4
 * - Se imprime por pantalla los datos de un juego
 * @param $juegos: array
 * @param $juegoIndice : int
 * @return void
 */
function datosDelJuego($juegosEjemplos,$num)
{
    $resultado = "";
    if ($juegosEjemplos[$num]["puntosCruz"] > $juegosEjemplos[$num]["puntosCirculo"]) {
        $resultado = "GANO X";
    } elseif ($juegosEjemplos[$num]["puntosCirculo"] > $juegosEjemplos[$num]["puntosCruz"]) {
        $resultado = "GANO O";
    } else {
        $resultado = "EMPATE";
    }

    echo "***************************\n";
    echo "Juego TATETI: " . $num+1 . " (" . $resultado . ")\n";
    echo "Jugador X: " . $juegosEjemplos[$num]["jugadorCruz"] . " obtuvo " . $juegosEjemplos[$num]["puntosCruz"] . " puntos\n";
    echo "Jugador O: " . $juegosEjemplos[$num]["jugadorCirculo"] . " obtuvo " . $juegosEjemplos[$num]["puntosCirculo"] . " puntos\n";
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

/**
 * EXPLICACION 3- Punto 6
 * Funcion que toma una coleccion de juegos y nombre de un jugador, 
 * retorna el indice del primer juego ganado, caso contrario, retorna -1
 * @param array $juegos
 * @param array $jugador
 * @return int
 *
 */
function primerJuegoGanado($juegos, $jugador)
{
    $indice = -1;
    $cantColJuegos = count($juegos);
    $a = 0;
    $encontro = FALSE;
    while ($a < $cantColJuegos && !$encontro) {
        if ($juegos[$a]["jugadorCruz"] == $jugador) {
            if ($juegos[$a]["puntosCruz"] > $juegos[$a]["puntosCirculo"]) {
                $encontro = true;
                $indice = $a;
            }
        } elseif ($juegos[$a]["jugadorCirculo"] == $jugador) {
            if ($juegos[$a]["puntosCirculo"] > $juegos[$a]["puntosCruz"]) {
                $encontro = true;
                $indice = $a;
            }
        }
        $a++;
    }
    return $indice;
}

/**
 * Módulo verificador que busca un jugador por el nombre ingresado en la colección de juegos
 * @param string $jugadorBuscado
 * @return int
 */
function verificador($juegosEncontrados, $jugadorBuscado) {
    $cantidadJuegos = count($juegosEncontrados);
    $jugadorEnPartidas = -1;
    for ($g=0; $g < $cantidadJuegos; $g++) {
        if ($juegosEncontrados[$g]["jugadorCruz"] == $jugadorBuscado || $juegosEncontrados[$g]["jugadorCirculo"] == $jugadorBuscado) {
            $jugadorEnPartidas = 1;
        }
    }
    return($jugadorEnPartidas);
}
/**
 * EXPLICACION 3- Punto 7
 * -Dada una coleccion de juegos y el nombre de un jugador
 * -Retorna el resumen
 * @param array $listadoJuegos
 * @param array $nombreDelJugador
 * @return array
 */
function resumen($listadoJuegos, $nombreDelJugador)
{
    $resumen = [
        "nombre" => "",
        "juegosGanados" => 0,
        "juegosPerdidos" => 0,
        "juegosEmpatados" => 0,
        "puntosAcumulados" => 0
    ];
    $auxNombre = "";
    $ganados = 0;
    $perdidos = 0;
    $empatados = 0;
    $puntosAcumulados = 0;
    $cantColeccionJuegos = count($listadoJuegos);
 
    for ($b = 0; $b < $cantColeccionJuegos; $b++) {
        if ($listadoJuegos[$b]["jugadorCruz"] == $nombreDelJugador) {
            $auxNombre = $nombreDelJugador;
            if ($listadoJuegos[$b]["puntosCruz"] > $listadoJuegos[$b]["puntosCirculo"]) {
                $ganados = $ganados + 1;
                $puntosAcumulados = $puntosAcumulados + $listadoJuegos[$b]["puntosCruz"];
            }
            if ($listadoJuegos[$b]["puntosCruz"] < $listadoJuegos[$b]["puntosCirculo"]) {
                $perdidos = $perdidos + 1;
            }
            if ($listadoJuegos[$b]["puntosCruz"] == $listadoJuegos[$b]["puntosCirculo"]) {
                $empatados = $empatados + 1;
                $puntosAcumulados = $puntosAcumulados + $listadoJuegos[$b]["puntosCruz"];
            }
        }
 
        if ($listadoJuegos[$b]["jugadorCirculo"] == $nombreDelJugador) {
            $auxNombre = $nombreDelJugador;
 
            if ($listadoJuegos[$b]["puntosCruz"] < $listadoJuegos[$b]["puntosCirculo"]) {
                $ganados = $ganados + 1;
                $puntosAcumulados = $puntosAcumulados + $listadoJuegos[$b]["puntosCirculo"];
            }
            if ($listadoJuegos[$b]["puntosCruz"] > $listadoJuegos[$b]["puntosCirculo"]) {
                $perdidos = $perdidos + 1;
            }
            if ($listadoJuegos[$b]["puntosCruz"] == $listadoJuegos[$b]["puntosCirculo"]) {
                $empatados = $empatados + 1;
                $puntosAcumulados = $puntosAcumulados + $listadoJuegos[$b]["puntosCirculo"];
            }
        }
    }
 
    $resumen["nombre"] = $auxNombre;
    $resumen["juegosGanados"] = $ganados;
    $resumen["juegosPerdidos"] = $perdidos;
    $resumen["juegosEmpatados"] = $empatados;
    $resumen["puntosAcumulados"] = $puntosAcumulados;

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
 * EXPLICACION 3 - Punto 8
 * - Funcion que solicita al usuario el símbolo X o O y en caso correcto lo retorna
 * @return string
 */
 
function validarSimbolo(){
    do {
        echo "Ingrese un símbolo X o O: ";
        $validar = strtoupper(trim(fgets(STDIN)));
        if ($validar != "X" && $validar != "O") {
            echo "Símbolo inválido\n";
        }
    } while ($validar != "X" && $validar != "O");
    return ($validar);
}

/**
 * EXPLICACION 3- Punto 9
 * - Funcion que recibe una colección de juegos
 * - Retorna la cantidad de juegos ganados
 * @param array $colecJuegos
 * @return int
 */
 
function juegosGanados($colecJuegos)
{
    $cantidadDeJuegosGanadosTotales = 0;
    for ($c = 0; $c < count($colecJuegos); $c++) {
        if ($colecJuegos[$c]["puntosCruz"] != 1) {
            $cantidadDeJuegosGanadosTotales++;
        }
    }
    return ($cantidadDeJuegosGanadosTotales);
}

 /**
 * Explicacion 3- Punto 10
 * - Funcion que recibe una colección de juegos y un símbolo
 * - Retorna la cantidad de juegos ganados de ese símbolo
 * @param array $colecDeJuegos
 * @param string $simbolo
 * @return int
 */
 
function juegoSimbolo($colecDeJuegos, $simbolo)
{
    $cantJuegosSimboloG = 0;
    for ($d = 0; $d < count($colecDeJuegos); $d++) {
        if ($simbolo == "X") {
            if ($colecDeJuegos[$d]["puntosCruz"] > 1) {
                $cantJuegosSimboloG++;
            }
        } else {
            if ($colecDeJuegos[$d]["puntosCirculo"] > 1) {
                $cantJuegosSimboloG++;
            }
        }
    }
    return ($cantJuegosSimboloG);
}

 /**
 * Explicacion 3- Punto 11
 * - Ordena alfabeticamente la coleccion de juego O.
 * @param array $coleccion
 * @return void 
 */
function ordenarJugadorO($coleccion){
    
    uasort($coleccion, function($e,$f){
        return strnatcmp($e["jugadorCirculo"], $f["jugadorCirculo"]);
    });
    print_r($coleccion);
}

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
// int , $numeroJuego, juegoABuscar, jugadorEnPartidas, primerJuegoGanado, juegosGanados, totalDeJuegos, jugadorExiste
// float $porcentaje
// ARRAY $jugar, juegosEncontrados
// string $buscarJugador, simbolo, nombre

//Inicialización de variables:
$juegosEncontrados= cargarJuegos();

//Proceso:

do {
    $opciones = seleccionarOpcion();
    switch ($opciones) {
        case 1:
            $jugar = jugar();
            $impResultado = imprimirResultado($jugar);
            $juegosEncontrados = agregarJuego($juegosEncontrados, $jugar);
            break;
        case 2:
            echo "Ingrese numero de juego: ";
            $numeroJuego = solicitarNumeroEntre(1, count($juegosEncontrados));
            datosDelJuego($juegosEncontrados, ($numeroJuego-1));
            break;
        case 3:
            echo "Ingrese el nombre del jugador a buscar: ";
            $buscarJugador = trim(fgets(STDIN));
            $jugadorEnPartidas = verificador($juegosEncontrados, strtoupper($buscarJugador));
            if ($jugadorEnPartidas == 1) {
                $indiceDelPrimerJuegoGanado = primerJuegoGanado($juegosEncontrados, strtoupper($buscarJugador));
                if ($indiceDelPrimerJuegoGanado == -1) {
                    echo "El jugador " . $buscarJugador . " no ganó ningún juego\n";
                }else {
                    datosDelJuego($juegosEncontrados, $indiceDelPrimerJuegoGanado);
                }
            }else {
                echo "El jugador " . $buscarJugador . " no participó de ningún juego\n";
            }
            break;
        case 4:
            $simbolo=validarSimbolo();
            $juegosGanados=juegoSimbolo ($juegosEncontrados,$simbolo);
            $totalDeJuegos=juegosGanados($juegosEncontrados);
            $porcentaje=($juegosGanados/$totalDeJuegos)*100;
            echo $simbolo." ganó el ".$porcentaje."% de juegos ganados.\n";
            break;
        case 5:
            echo "Ingrese el nombre de un jugador: ";
            $nombre = trim(fgets(STDIN));
            $jugadorExiste = primerJuegoGanado($juegosEncontrados, strtoupper($nombre));
            if ($jugadorExiste == 1) {
                resumen($juegosEncontrados,strtoupper($nombre));
            }else {
                echo "El jugador ". $nombre . " no jugó ninguna partida.\n";
            }
            break;
        case 6:
            ordenarJugadorO($juegosEncontrados);
            break;
         case 7:
            echo "
            █▀▀ █▄░█ █▀▄ . ▄▀▀▄ █▀▀ . ▄▀▀ ▄▀▄ ██▄██ █▀▀
            █▀▀ █▀██ █░█ . █░░█ █▀▀ . █░█ █▄█ █░▀░█ █▀▀
            ▀▀▀ ▀░░▀ ▀▀░ . ░▀▀░ ▀░░ . ░▀▀ ▀░▀ ▀░░░▀ ▀▀▀
            ";
            break;
    }
} while ($opciones !=7);