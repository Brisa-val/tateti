<?php
include_once("tateti.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Rodriguez, Nicolas. Legajo: FAI-3704. Carrera: Tecnicatura Universitaria en Desarrollo Web. niko.0493@gmail.com. Usuario Github: nicolas-rodrigue */
/* Valdebenito, brisa. Legajo: FAI-3781. Carrera: Tecnicatura Universitaria en Desarrollo Web. brisavaldebenito400@gmail.com . Usuario Github: Brisa-val */ 


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
    do{ 
    echo "Menú de opciones: \n";
    echo "   1) Jugar al tateti  \n";
    echo "   2) Mostrar un juego \n";
    echo "   3) Mostrar el primer juego ganador  \n";
    echo "   4) Mostrar porcentaje de Juegos ganados \n";
    echo "   5) Mostrar resumen de Jugador\n";
    echo "   6) Mostrar listado de juegos Ordenado por jugador O\n";
    echo "   7) Salir\n";
    echo "Ingrese opcion: ";
    // obteniendo un valor valido de las opciones del menu
    $opcion = trim(fgets(STDIN));
        if (!(is_int($opcion)) && !($opcion >= 1 && $opcion <= 7)) {
            echo "Opcion NO Valida." . "\n";
        }
    } while (!(is_int($opcion)) && !($opcion >= 1 && $opcion <= 7));
    return $opcion;
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
        echo "ingrese un numero: ";
        $valor = trim(fgets(STDIN));
        //se verifica si el valor ingresado es un numero 
        $isNumber = is_numeric($valor);
        if ($isNumber)
        {
            $valor = (int) $valor;
            if ($valor >= 1 && $valor <= 7)
            {
                $isValid = true;
            }
            else
            {
                echo "la opcion a elegir debe estar ser entre 1 y 7 inclusive .\n";
            }
        }
        else
        {
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
function mostrarJuego($juegos, $juegoIndice)
{
    // resultado del partido
    $resultado = "";
    if ($juegos[$juegoIndice]["puntosCruz"] > $juegos[$juegoIndice]["puntosCirculo"]) {
        $resultado = "gano X";
    } elseif ($juegos[$juegoIndice]["puntosCirculo"] > $juegos[$juegoIndice]["puntosCruz"]) {
        $resultado = "gano Y";
    } else {
        $resultado = "empate";
    }

    echo "***************************";
    echo "Juego TATETI: " . $juegoIndice . "(" . $resultado . ")";
    echo "Jugador X: " . $juegos[$juegoIndice]["jugadorCruz"] . " obtuvo " . $juegos[$juegoIndice]["puntosCruz"] . " puntos";
    echo "Jugador O: " . $juegos[$juegoIndice]["jugadorCirculo"] . " obtuvo " . $juegos[$juegoIndice]["puntosCirculo"] . " puntos";
    echo "***************************";
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
 
    //recorro la coleccion de juegos hasta encontrar el nombre del Jugador
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
 * Explicacion 3- Punto 10
 * - Funcion que tiene por enetrada colección de juegos y un símbolo
 * - Retorna la cantidad de juegos ganados por el símbolo ingresado por parámetro.
 * @param array $juegosColeccion
 * @param string $simbol
 * @return int
 */

function juegoGanadorSimbolo($juegosColeccion,$simbol){

    $cantGanadores = 0;
    for ($i = 0; $i < count($juegosColeccion); $i++) {
        if ($simbol == "O") {
            if ($juegosColeccion[$i]["puntosO"] > 1) {
                $cantGanadores++;
            }
        } else {
            if ($juegosColeccion[$i]["puntosX"] > 1) {
                $cantGanadores++;
            }
        }
    }
    return ($cantGanadores);
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

do {
    $respuesta = seleccionarOpcion();
    switch ($respuesta) {
        case 1:
            // Ejecutamos las funciones de tateti.php para inciar un juego y guardamos el resultado en el array asociativo $nuevoJuego
            $nuevoJuego = jugar();
            // Una vez completado el juego y guardado el resultado lo agregamos a nuestra base de datos donde están todos nuestros juegos
            $juegosCargados = agregarJuego($juegosCargados, $Juego);
            break;
        case 2:
            $buscarJuego = obtenerNumeroValidoMenu();
            datosDelJuego($juegosCargados, ($buscarJuego - 1));
            break;
        case 3:
            echo "Ingrese el nombre del jugador a buscar: ";
            $nombreJugadorABuscar = trim(fgets(STDIN));
            $jugadorEnPartidas = jugadorJugoConNombre($juegosCargados, strtoupper($nombreJugadorABuscar));
            if ($jugadorEnPartidas == 1) {
                $indiceDelPrimerJuegoGanado = indicePrimerJuegoGanado($juegosCargados, strtoupper($nombreJugadorABuscar));
                if ($indiceDelPrimerJuegoGanado == -1) {
                    echo "El jugador " . $nombreJugadorABuscar . " no ganó ningún juego\n";
                }
                else {
                    mostrarJuego($juegosCargados, $indiceDelPrimerJuegoGanado);
                }
            }
            else {
                echo "El jugador " . $nombreJugadorABuscar . " no participó de ningún juego\n";
            }
           
            break;
        case 4:
            $simbolo=validarSimbolo();
            $juegosGanados=ordenarPorO($juegosCargados,$simbolo);
            $totalDeJuegos=juegosGanados($juegosCargados);
            $porcentaje=($juegosGanados/$totalDeJuegos)*100;
            echo $simbolo." ganó el ".$porcentaje."% de juegos ganados.\n";
            break;
        case 5:
            // Se le solicita al usuario un nombre de jugador y se muestra en pantalla
            // un resumen de los juegos ganados, los juegos perdidos, empates y puntos acumulados.
            echo "Ingrese el nombre de un jugador: ";
            $nombre = trim(fgets(STDIN));
 
            // Comprobamos si el nombre del jugador ingresado se encuentra en alguno de los juegos almacenados.
            // Si existe, retorna 1 y sino retorna -1.
            $jugadorExiste = jugadorJugoConNombre($listaDeJuegos, strtoupper($nombre));
 
            if ($jugadorExiste == 1) {
                auxMostrarResumen(resumenJugador($listaDeJuegos, strtoupper($nombre)));
            }
            else {
                echo "El jugador ". $nombre . " no jugó ninguna partida.\n";
            }
            break;
        case 6:
            // Se mostrará en pantalla la estructura ordenada alfabéticamente por jugador O,
            // utilizando la función predefinida uasort de php, y la función predefinida print_r.
            ordenarJugadorO($juegosCargados);
            break;
         case 7:
            // Muestra un cartel de finalizacion de programa
            echo "
            ▄▀▀ ▄▀▄ ██▄██ █▀▀ . ▄▀▀▄ █░░░█ █▀▀ █▀▄
            █░█ █▄█ █░▀░█ █▀▀ . █░░█ ░█░█░ █▀▀ █▀▄
            ░▀▀ ▀░▀ ▀░░░▀ ▀▀▀ . ░▀▀░ ░░▀░░ ▀▀▀ ▀░▀";
            break;
    };
} while ($respuesta != 7);
