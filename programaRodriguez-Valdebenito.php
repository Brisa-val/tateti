<?php
include_once("tateti.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* ... COMPLETAR ... */ 


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * (punto 1)
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
 * (punto 2)
 * funcion que se encarga de:
 * - mostrar el menu general del juego.
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
 * (punto 3)
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
 * (punto 4)
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
 *(punto5)
*modificada al agregarse el nuevo juego
* @return int
*/
function agregarJuego ()
{  

}


/**
* (punto6)
*
*
*/


/**
 * (PUNTO 7)
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
 * (punto8)
 *
 */


/**
 * (punto9)
 */

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:
// variable q almacenera la coleccion de juegos
$coleccionJuegos = [];
$juego = ["jugadorCruz" => "", "jugadorCirculo" => "", "puntosCruz" => 0, "puntosCirculo" => 0];

//Proceso:

$juego = jugar();
//print_r($juego);
//imprimirResultado($juego);



/*
do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/