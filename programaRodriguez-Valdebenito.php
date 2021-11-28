<?php
include_once("tateti.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Rodriguez, Nicolas. Legajo: FAI-3704. Carrera: Tecnicatura Universitaria en Desarrollo Web. niko.0493@gmail.com. Usuario Github: nicolas-rodrigue */
/* ... COMPLETAR ... */ 


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
    $juegosEjemplos[0] = ["jugadorCruz" => "majo", "jugadorCirculo" => "pepe", "puntosCruz" => 5, "puntosCirculo" => 0];
    $juegosEjemplos[1] = ["jugadorCruz" => "nicolas", "jugadorCirculo" => "brisa", "puntosCruz" => 1, "puntosCirculo" => 1];
    $juegosEjemplos[2] = ["jugadorCruz" => "ana", "jugadorCirculo" => "lisa", "puntosCruz" => 1, "puntosCirculo" => 1];
    $juegosEjemplos[3] = ["jugadorCruz" => "brisa", "jugadorCirculo" => "pepe", "puntosCruz" => 3, "puntosCirculo" => 0];
    $juegosEjemplos[4] = ["jugadorCruz" => "brisa", "jugadorCirculo" => "majo", "puntosCruz" => 0, "puntosCirculo" => 1];
    $juegosEjemplos[5] = ["jugadorCruz" => "ana", "jugadorCirculo" => "brisa", "puntosCruz" => 1, "puntosCirculo" => 1];
    $juegosEjemplos[6] = ["jugadorCruz" => "majo", "jugadorCirculo" => "sebastian", "puntosCruz" => 0, "puntosCirculo" => 3];
    $juegosEjemplos[7] = ["jugadorCruz" => "sebastian", "jugadorCirculo" => "majo", "puntosCruz" => 1, "puntosCirculo" => 1];
    $juegosEjemplos[8] = ["jugadorCruz" => "sebastian", "jugadorCirculo" => "lisa", "puntosCruz" => 0, "puntosCirculo" => 1];
    $juegosEjemplos[9] = ["jugadorCruz" => "sebastian", "jugadorCirculo" => "brisa", "puntosCruz" => 0, "puntosCirculo" => 5];

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
    echo "Menú de opciones:";
    echo "   1) Jugar al tateti ";
    echo "   2) Mostrar un juego";
    echo "   3) Mostrar el primer juego ganador ";
    echo "   4) Mostrar porcentaje de Juegos ganados";
    echo "   5) Mostrar resumen de Jugador";
    echo "   6) Mostrar listado de juegos Ordenado por jugador O";
    echo "   7) Salir";

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
 * Se imprime por pantalla los datos de un juego
 * @param $juegos: array
 * @param $juegoIndice : int
 * @return void
 */
function datosDelJuego($juegos, $juegoIndice)
{
    // resultado del partido
    $resultado = "";
    if ($juegos[$juegoIndice]["puntosCruz"] > $juegos[$juegoIndice]["puntosCirculo"])
    {
        $resultado = "gano X";
    }
    elseif ($juegos[$juegoIndice]["puntosCirculo"] > $juegos[$juegoIndice]["puntosCruz"])
    {
        $resultado = "gano Y";
    }
    else
    {
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

/**
* (punto6)
*
*
*/

function primerJuegoGanado($juegos){
    echo "Ingrese el nombre del jugador: ";
    $nombreJugador = strtoupper(trim(fgets(STDIN)));
    
    foreach ($juegos as $indice => $juego) {
        if ($juego["nombreJugadorX"] == $nombreJugador && $juego["puntosObtenidosX"] > $juego["puntosObtenidosO"]){
            $juegoGanado = $juego;
        }elseif ($juego["nombreJugadorO"] == $nombreJugador && $juego["puntosObtenidosO"] > $juego["puntosObtenidosX"]) {
            $juegoGanado = $juego;
        }else {
            $juegoGanado = [];
        }
    }
    return $juegoGanado;
}

/**
 * Punto 6
 * Se obtiene el primer juego ganado de un jugador
 * @param $juegos: arreglo indexado que contiene una estructura asociativa -> [["jugadorCruz" => "", "jugadorCirculo" => "", "puntosCruz" => 0, "puntosCirculo" => 0], n]
 * @param $jugador: String
 */
function indicePrimerJuegoGanado($juegos, $jugador)
{
    $indice = -1;
    for ($x = 0; $x < count($juegos); $x++)
    {
        // si se encontro un juego ganador, este valor adquiere otro valor y ya no debemos buscar en el array
        if ($indice > -1)
        {
            // de las 2 opciones que tenemos vemos cual es nuestro jugador y lo comparamos con el oponente
            if ($jugador == $juegos[$x]["jugadorCruz"] && $juegos[$x]["puntosCruz"] > $juegos[$x]["puntosCirculo"])
            {
                $indice = $x;
            }
            elseif ($jugador == $juegos[$x]["jugadorCirculo"] && $juegos[$x]["puntosCirculo"] > $juegos[$x]["puntosCruz"])
            {
                $indice = $x;
            }
        }
    }
    return  $indice;
}

/**
 * EXPLICACION 3- Punto 7
 * Dada una coleccion de juegos y el nombre de un jugador, retorna el
 * resumen del jugador utilizando la estructura b) de la EXPLICACION 2.
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
 * EXPLICACION 3- Punto 7
 * Metodo que muestra el resumen de un jugador, recibe un resumen y lo muestra por pantalla ~7
 * @param array $resumen
 *
 */
function auxMostrarResumen($resumen){
    echo "****************************** \n";
    echo "Jugador: ".$resumen["nombre"]."\n";
    echo "Ganó: ".$resumen["juegosGanados"]." juegos \n";
    echo "Perdió: ".$resumen["juegosPerdidos"]." juegos \n";
    echo "Empató: ".$resumen["juegosEmpatados"]." juegos \n";
    echo "Total de puntos acumulados: ".$resumen["puntosAcumulados"]." puntos \n";
    echo "****************************** \n";
}
/**
*    function resumenJugador($juegos){
*   echo "ingrese el nombre del jugador: ";
*    $nombreJugador = strtoupper(trim(fgets(STDIN)));
*    
*    foreach ($juegos as $indice => $juego) {
*        if($juego["nombreJugadorX"] == $nombreJugador || $juego["nombreJugadorO"] == $nombreJugador){

*        }
*
*    }

*   }
 */

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
 * Funcion que recibe una colección de juegos y retorna la cantidad de juegos ganados
 * @param array $colecJuegos
 * @return int
 */
 
function juegosGanados($colecJuegos)
{
 
    // Inicializamos nuestra variable contadora que nos dirá la cantidad total de partidas ganadas, independiente de que jugador haya ganado.
 
    $cantidadDeJuegosGanadosTotales = 0;
 
    // Hay varias formas de resolverlo, poniendo que los puntos de uno son mayor al otro o viceversa.
    // Diferenciar el puntaje de 1 es lo mas fácil y optimizado para saber que uno de los 2 ganó.
 
    for ($k = 0; $k < count($colecJuegos); $k++) {
        if ($colecJuegos[$k]["puntosCruz"] != 1) {
            $cantidadDeJuegosGanadosTotales++;
        }
    }
    return ($cantidadDeJuegosGanadosTotales);
}

 /**
 * Explicacion 3- Punto 10
 */

function ordenarPorO($coleccionJuegos,$juegos){

    $cantGanardoresO = 0;

    foreach ($juegos as $indice => $juego) {

        if($juegos[$indice]== "ganador0"){

            $cantGanardoresO = $cantGanardoresO + 1;

            return $cantGanardoresO;
        }
    }
}

 /**
 * Explicacion 3- Punto 11
 */
function ordenarOAlfabetic($juegosEjemplos){

    $juegosEjemplos = [0,1,2,3,4,5,6,7,8,9];
    
    $juego=[];

    foreach($juegosEjemplos as $indice => $valor){
        if($valor == "jugadorCirculo"){
            var_dump($indice);
            var_dump($valor);
            $juego[$indice] = $valor;
            sort($juego[$indice]);
            print_r($juego);
        }
        
    }
    var_dump($juego);
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
$juegosCargados= cargarJuegos()

//Proceso:

do {
    $respuesta = selectionarOpcion();
    switch ($respuesta) {
        case 1:
            // Ejecutamos las funciones de tateti.php para inciar un juego y guardamos el resultado en el array asociativo $nuevoJuego
            $nuevoJuego = jugar();
            // Una vez completado el juego y guardado el resultado lo agregamos a nuestra base de datos donde están todos nuestros juegos
            $juegosCargados = agregarJuego($juegosCargados, $Juego);
            break;
        case 2:
            // Solicitamos un número de juego y después de validarlo lo buscamos dentro de la lista de juegos.
            $buscarJuego = obtenerNumeroValidoMenu(1, count($juegosCargados));
            datosDelJuego($juegosCargados, ($buscarJuego - 1));
            break;
        case 3:
            echo "Ingrese el nombre del jugador a buscar: ";
            $buscandoJugador = strtoupper(fgets(STDIN));
            $jugadorEnPartidas = ordenarOAlfabetic($juegosCargados, strtoupper($nombreJugadorABuscar));
 
            if ($jugadorEnPartidas == 1) {
                $primerJuegoGanado = indicePrimerJuegoGanado($juegosCargados, $buscandoJugador);
                if ($primerJuegoGanado == -1) {
                    echo "El jugador " . $buscandoJugador . " no ganó ningún juego\n";
                }
                else {
                    datosDelJuego($juegosCargados, $primerJuegoGanado);
                }
            }
            else {
                echo "El jugador " . $buscandoJugador . " no participó de ningún juego\n";
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
            juegosOrdenadosParaJugadorO($listaDeJuegos);
            break;
         case 7:
            // Muestra un cartel de finalizacion de programa
            echo "FINALIZO EL PROGRAMA.";
            break;
    }
} while ($respuesta != 7);
