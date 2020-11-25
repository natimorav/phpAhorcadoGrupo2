<?php
/******************************************
 * Grupo 2: //
 * NATALIA PAMELA MORA VÁSQUEZ - FAI 2151
 * MATIAS FEDERICO PERALTA MACRI - FAI 3077
 * PABLO DAMIAN ROMERO - FAI 1652
 *
 * Enlace gitHub: https://github.com/PabloDamianRomero/phpAhorcadoGrupo2.git
 ******************************************/

/**
 * Punto 1)
 * Genera un arreglo de palabras para jugar
 * @return array
 */
function cargarPalabras()
{
    //array $coleccionPalabras
    $coleccionPalabras = array();
    $coleccionPalabras[0] = array("palabra" => "papa", "pista" => "se cultiva bajo tierra", "puntosPalabra" => 7);
    $coleccionPalabras[1] = array("palabra" => "hepatitis", "pista" => "enfermedad que inflama el higado", "puntosPalabra" => 7);
    $coleccionPalabras[2] = array("palabra" => "volkswagen", "pista" => "marca de vehiculo", "puntosPalabra" => 10);
    $coleccionPalabras[3] = array("palabra" => "futbol", "pista" => "deporte grupal", "puntosPalabra" => 7);
    $coleccionPalabras[4] = array("palabra" => "libelula", "pista" => "insecto volador", "puntosPalabra" => 8);
    $coleccionPalabras[5] = array("palabra" => "labrador", "pista" => "raza de perro", "puntosPalabra" => 7);
    $coleccionPalabras[6] = array("palabra" => "bhaskara", "pista" => "formula para determinar raices de un polinomio", "puntosPalabra" => 10);
    return $coleccionPalabras;
}

/**
 * Punto 2)
 * Genera un arreglo de juegos jugados
 *
 */
function cargarJuegos()
{
    // array $coleccionJuegos
    $coleccionJuegos = array();
    $coleccionJuegos[0] = array("puntos" => 0, "indicePalabra" => 1);
    $coleccionJuegos[1] = array("puntos" => 10, "indicePalabra" => 2);
    $coleccionJuegos[2] = array("puntos" => 0, "indicePalabra" => 1);
    $coleccionJuegos[3] = array("puntos" => 8, "indicePalabra" => 0);
    $coleccionJuegos[4] = array("puntos" => 10, "indicePalabra" => 6);
    $coleccionJuegos[5] = array("puntos" => 0, "indicePalabra" => 4);
    $coleccionJuegos[6] = array("puntos" => 7, "indicePalabra" => 5);
    return $coleccionJuegos;
}

/**
 * Punto 3)
 * a partir de la palabra genera un arreglo para determinar si sus letras fueron o no descubiertas
 * @param string $palabra
 * @return array
 */
function dividirPalabraEnLetras($palabra)
{
    //array $coleccionLetras
    //int $longitudPalabra, $i
    $coleccionLetras = str_split($palabra);
    $longitudPalabra = strlen($palabra);
    for ($i = 0; $i < $longitudPalabra; $i++) {
        $coleccionLetras[$i] = array("letra" => str_split($palabra)[$i], "descubierta" => false);
    }
    return $coleccionLetras;
}

/**
 * Muestra y obtiene una opcion de menú ***válida***
 * Punto 4)
 * @return int
 */
function seleccionarOpcion()
{
    // $int $opcion
    echo "--------------------------------------------------------------\n";
    echo "\n ( 1 ) Jugar con una palabra aleatoria";
    echo "\n ( 2 ) Jugar con una palabra elegida";
    echo "\n ( 3 ) Agregar una palabra al listado";
    echo "\n ( 4 ) Mostrar la información completa de un número de juego";
    echo "\n ( 5 ) Mostrar la información completa del primer juego con más puntaje";
    echo "\n ( 6 ) Mostrar la información completa del primer juego que supere un puntaje indicado por el usuario";
    echo "\n ( 7 ) Mostrar la lista de palabras ordenada por orden alfabético";
    echo "\n ( 8 ) Salir";
    do {
        echo "\n Indique una opción válida:";
        $opcion = trim(fgets(STDIN));
    } while (($opcion < 1) || ($opcion > 8));
    echo "--------------------------------------------------------------\n";
    return $opcion;
}

/**
 * Punto 5)
 * Determina si una palabra existe en el arreglo de palabras
 * @param array $coleccionPalabras
 * @param string $palabra
 * @return boolean
 */
function existePalabra($coleccionPalabras, $palabra)
{
    // Int $i, $cantPal
    // Boolean $existe
    $i = 0;
    $cantPal = count($coleccionPalabras);
    $existe = false;
    while ($i < $cantPal && !$existe) {
        $existe = $coleccionPalabras[$i]["palabra"] == $palabra;
        $i++;
    }
    return $existe;
}

/**
 * Punto 6)
 * Determina si una letra existe en el arreglo de letras
 * @param array $coleccionLetras
 * @param string $letra
 * @return boolean
 */
function existeLetra($coleccionLetras, $letra)
{
    //Int $i, $cantLetras
    //Boolean $existe
    $i = 0;
    $cantLetras = count($coleccionLetras);
    $existe = false;
    while (($i < $cantLetras) && ($existe == false)) {
        if (($coleccionLetras[$i]["letra"]) == $letra) {
            $existe = true;
        }
        $i++;
    }
    return $existe;
}

/**
 * Punto 7)
 * Solicita los datos correspondientes a un elemento de la coleccion de palabras: palabra, pista y puntaje.
 * Internamente la función también verifica que la palabra ingresada por el usuario no exista en la colección de palabras.
 * @param array $coleccionPalabras
 * @return array  colección de palabras modificada con la nueva palabra.
 */
function cargarNuevaPalabra($coleccionPalabras)
{
    //Int $longitudArreglo, $nuevoPuntoPorPalabra
    //String $nuevaPalabra, $nuevaPista
    //Boolean $coincidencia
    $longitudArreglo = count($coleccionPalabras);
    do {
        echo "Ingrese la palabra: ";
        $nuevaPalabra = strtolower(trim(fgets(STDIN))); //convierte la palabra a minuscula
        $coincidencia = existePalabra($coleccionPalabras, $nuevaPalabra);
        if ($coincidencia == false) {
            echo "Ingrese pista: ";
            $nuevaPista = strtolower(trim(fgets(STDIN)));
            echo "Ingrese puntaje: ";
            $nuevoPuntoPorPalabra = trim(fgets(STDIN));
            $coleccionPalabras[$longitudArreglo] = array("palabra" => $nuevaPalabra, "pista" => $nuevaPista, "puntosPalabra" => $nuevoPuntoPorPalabra);
        } else {
            echo "La palabra ya existe\n";
        }
    } while ($coincidencia == true);
    return $coleccionPalabras;
}

/**
 * Punto 8)
 * Obtener indice aleatorio
 * @param int $min
 * @param int $max
 * @return int devuelve un indice entero
 */
function indiceAleatorioEntre($min, $max)
{
    //Int $i
    $i = rand($min, $max); // obtener un número aleatorio entre $min y $max (incluidos)
    return $i;
}

/**
 * Punto 9)
 * solicitar un valor entre min y max
 * @param int $min
 * @param int $max
 * @return int
 */
function solicitarIndiceEntre($min, $max)
{
    //Int $i
    do {
        echo "Seleccione un valor entre $min y $max: ";
        $i = trim(fgets(STDIN));
    } while (!($i >= $min && $i <= $max));

    return $i;
}

/**
 * Punto 10)
 * Determinar si la palabra fue descubierta, es decir, todas las letras fueron descubiertas
 * @param array $coleccionLetras
 * @return boolean
 */
function palabraDescubierta($coleccionLetras)
{
    //Boolean $descubierta
    //Int $longitudColeccion, $i
    $descubierta = true;
    $longitudColeccion = count($coleccionLetras);
    $i = 0;
    while (($descubierta) && ($i < $longitudColeccion)) {
        if ($coleccionLetras[$i]["descubierta"] != true) {
            $descubierta = false;
        }
        $i++;
    }
    return $descubierta;
}

/**
 * Punto 11)
 * valida que un String ingresado tenga un único caracter
 */
function solicitarLetra()
{
    //Boolean $letraCorrecta
    //String $letra
    $letraCorrecta = false;
    do {
        echo "\n--------------------------------------------------------------\n";
        echo "\nIngrese una letra: ";
        $letra = strtolower(trim(fgets(STDIN)));
        if (strlen($letra) != 1) {
            echo "Debe ingresar 1 letra!\n";
        } else {
            $letraCorrecta = true;
        }
    } while (!$letraCorrecta);

    return $letra;
}

/**
 * Punto 12)
 * Descubre todas las letras de la colección de letras iguales a la letra ingresada.
 * Devuelve la coleccionLetras modificada, con las letras descubiertas
 * @param array $coleccionLetras
 * @param string $letra
 * @return array colección de letras modificada.
 */
function destaparLetra($coleccionLetras, $letra)
{
    //Int $longitudArreglo, $i
    $longitudArreglo = count($coleccionLetras);
    for ($i = 0; $i < $longitudArreglo; $i++) {
        if ($coleccionLetras[$i]["letra"] == $letra) {
            $coleccionLetras[$i]["descubierta"] = true;
        }
    }
    return $coleccionLetras;
}

/**
 * Punto 13)
 * obtiene la palabra con las letras descubiertas y * (asterisco) en las letras no descubiertas. Ejemplo: he**t*t*s
 * @param array $coleccionLetras
 * @return string  Ejemplo: "he**t*t*s"
 */
function stringLetrasDescubiertas($coleccionLetras)
{
    //String $pal,
    //Int $longitudColeccion, $i
    $pal = "";
    $longitudColeccion = count($coleccionLetras);
    for ($i = 0; $i < $longitudColeccion; $i++) {
        if ($coleccionLetras[$i]["descubierta"] == true) {
            $pal = $pal . $coleccionLetras[$i]["letra"];
        } else {
            $pal = $pal . "*";
        }
    }
    return $pal;
}

/**
 * Punto 14)
 * Desarrolla el juego y retorna el puntaje obtenido
 * Si descubre la palabra se suma el puntaje de la palabra más la cantidad de intentos que quedaron
 * Si no descubre la palabra el puntaje es 0.
 * @param array $coleccionPalabras
 * @param int $indicePalabra
 * @param int $cantIntentos
 * @return int puntaje obtenido
 */
function jugar($coleccionPalabras, $indicePalabra, $cantIntentos)
{
    //String $pal, $letra
    //array $coleccionLetras
    //Int $puntaje, $cantIntentos
    //Boolean $palabraFueDescubierta;$existenciaDeLetra
    $pal = $coleccionPalabras[$indicePalabra]["palabra"];
    $coleccionLetras = dividirPalabraEnLetras($pal);
    //print_r($coleccionLetras);
    $puntaje = 0;
    $palabraFueDescubierta = false;

    //Mostrar pista:
    echo "Pista: " . $coleccionPalabras[$indicePalabra]["pista"];

    //solicitar letras mientras haya intentos y la palabra no haya sido descubierta:
    do {
        $letra = solicitarLetra(); // Comprueba que sea un solo caracter (p11)
        $existenciaDeLetra = existeLetra($coleccionLetras, $letra); // (p6)
        if ($existenciaDeLetra) {
            echo "\nLa letra '" . $letra . "' PERTENECE a la palabra.";
            $coleccionLetras = destaparLetra($coleccionLetras, $letra); // (p12)
        } else {
            dibujar($cantIntentos);
            $cantIntentos--;
            echo "\nLa letra '" . $letra . "' NO pertenece a la palabra. Quedan " . $cantIntentos . " intentos";
        }
        echo "\nPalabra a descubrir: " . stringLetrasDescubiertas($coleccionLetras); // (p13)
        $palabraFueDescubierta = palabraDescubierta($coleccionLetras); // (p10)

    } while ($cantIntentos != 0 && !$palabraFueDescubierta);
    if ($palabraFueDescubierta) {
        //obtener puntaje:
        $puntaje = $puntaje + $coleccionPalabras[$indicePalabra]["puntosPalabra"] + $cantIntentos;
        echo "\n¡¡¡¡¡¡GANASTE " . $puntaje . " puntos!!!!!!\n";
    } else {
        echo "\n¡¡¡¡¡¡AHORCADO AHORCADO!!!!!!\n";
    }
    return $puntaje;
}

/**
 * Punto 15)
 * Agrega un nuevo juego al arreglo de juegos
 * @param array $coleccionJuegos
 * @param int $puntos
 * @param int $indicePalabra
 * @return array coleccion de juegos modificada
 */
function agregarJuego($coleccionJuegos, $puntos, $indicePalabra)
{
    $coleccionJuegos[] = array("puntos" => $puntos, "indicePalabra" => $indicePalabra);
    return $coleccionJuegos;
}

/**
 * Punto 16)
 * Muestra los datos completos de un registro en la colección de palabras
 * @param array $coleccionPalabras
 * @param int $indicePalabra
 */
function mostrarPalabra($coleccionPalabras, $indicePalabra)
{
    //$coleccionPalabras[0]= array("palabra"=> "papa" , "pista" => "se cultiva bajo tierra", "puntosPalabra"=>7);
    echo "    " . "palabra: ";
    print_r($coleccionPalabras[$indicePalabra]["palabra"]);
    echo "\n" . "    " . "pista: ";
    print_r($coleccionPalabras[$indicePalabra]["pista"]);
    echo "\n" . "    " . "puntosPalabra: ";
    print_r($coleccionPalabras[$indicePalabra]["puntosPalabra"]);
}

/**
 * Punto 17)
 * Muestra los datos completos de un juego
 * @param array $coleccionJuegos
 * @param array $coleccionPalabras
 * @param int $indiceJuego
 */
function mostrarJuego($coleccionJuegos, $coleccionPalabras, $indiceJuego)
{
    //array("puntos"=> 8, "indicePalabra" => 1)
    echo "\n\n";
    echo "<-<-< Juego " . $indiceJuego . " >->->\n";
    echo "  Puntos ganados: " . $coleccionJuegos[$indiceJuego]["puntos"] . "\n";
    echo "  Información de la palabra:\n";
    mostrarPalabra($coleccionPalabras, $coleccionJuegos[$indiceJuego]["indicePalabra"]);
    echo "\n";
}

/**
 * Punto 18) (Opcion 5 de menú)
 * Obtiene indice de la primer partida con mayor puntaje.
 * @param array $coleccionJuegos
 * @return int
 */
function indiceMayorPunt($coleccionJuegos)
{
    //Int $puntuacion, $n, $i, $indice
    //Boolean $bandera
    $puntuacion = 0;
    $n = count($coleccionJuegos);
    for ($i = 0; $i < $n; $i++) {
        if ($coleccionJuegos[$i]["puntos"] > $puntuacion) {
            $indice = $i;
            $puntuacion = $coleccionJuegos[$i]["puntos"];
        }
    }
    return $indice;
}

/**
 * Punto 19) (Opcion 6 de menú)
 * De ser posible, obtiene el índice de la primer partida con puntaje superior al parámetro ingresado
 * @param array $coleccionJuegos
 * @param int $puntaje
 * @return int
 */
function superarPuntaje($coleccionJuegos, $puntaje)
{
    //Int $n, $i, $indice
    //Boolean $bandera
    $n = count($coleccionJuegos);
    $bandera = true;
    $i = 0;
    while ($i < $n && $bandera) {
        if ($coleccionJuegos[$i]["puntos"] > $puntaje) {
            $indice = $i;
            $bandera = false;
        } else {
            $indice = -1;
        }
        $i++;
    }
    return $indice;
}

/**
 * Punto 20) (Opcion 7 de menú)
 * Muestra la colección ordenada alfabeticamente.
 * @param array $coleccionPalabras
 */

function ordenarPal($coleccionPalabras)
{
    asort($coleccionPalabras); //ordena los elementos de menor a mayor, manteniendo la correlacion de los indicies
    print_r($coleccionPalabras);
}

/**
 * Muestra la representación gráfica del ahorcado
 * @param int $valor
 */
function dibujar($valor)
{
    // String $cadena
    $cadena = "";
    $cadena = $cadena . "+-----+\n";
    $cadena = $cadena . "|     |\n";
    switch ($valor) {
        case 6:
            $cadena = $cadena . "|     O\n";
            $cadena = $cadena . "|\n";
            $cadena = $cadena . "|\n";
            $cadena = $cadena . "|";
            break;
        case 5:
            $cadena = $cadena . "|     O\n";
            $cadena = $cadena . "|    /\n";
            $cadena = $cadena . "|\n";
            $cadena = $cadena . "|";
            break;
        case 4:
            $cadena = $cadena . "|     O\n";
            $cadena = $cadena . "|    /|\n";
            $cadena = $cadena . "|\n";
            $cadena = $cadena . "|";
            break;
        case 3:
            $cadena = $cadena . "|     O\n";
            $cadena = $cadena . "|    /|)\n";
            $cadena = $cadena . "|\n";
            $cadena = $cadena . "|";
            break;
        case 2:
            $cadena = $cadena . "|     O\n";
            $cadena = $cadena . "|    /|)\n";
            $cadena = $cadena . "|    / \n";
            $cadena = $cadena . "|";
            break;
        case 1:
            $cadena = $cadena . "|     O\n";
            $cadena = $cadena . "|    /|)\n";
            $cadena = $cadena . "|    / )\n";
            $cadena = $cadena . "|";
            break;
    }
    $cadena = $cadena . "\n---";
    echo $cadena;
}

/******************************************/
/************** PROGRAMA PRINCIPAL *********/
/******************************************/
define("CANT_INTENTOS", 6); //Constante en php para cantidad de intentos que tendrá el jugador para adivinar la palabra.
$coleccionPalabras = cargarPalabras();
$coleccionJuegos = cargarJuegos();
do {
    $maximo = (count($coleccionPalabras)) - 1;
    $opcion = seleccionarOpcion();
    switch ($opcion) { // Es similar a una sentencia IF. Sirve para comparar la misma variable (o expresión) con muchos valores diferentes, y ejecutar una parte de código distinta dependiendo de a que valor es igual.
        case 1: //Jugar con una palabra aleatoria
            $indice = indiceAleatorioEntre(0, $maximo);
            $puntuacion = jugar($coleccionPalabras, $indice, CANT_INTENTOS);
            $coleccionJuegos = agregarJuego($coleccionJuegos, $puntuacion, $indice);
            break;
        case 2: //Jugar con una palabra elegida
            $elegirPalabra = solicitarIndiceEntre(0, $maximo);
            $puntuacion = jugar($coleccionPalabras, $elegirPalabra, CANT_INTENTOS);
            $coleccionJuegos = agregarJuego($coleccionJuegos, $puntuacion, $elegirPalabra);
            break;
        case 3: //Agregar una palabra al listado
            $coleccionPalabras = cargarNuevaPalabra($coleccionPalabras);
            break;
        case 4: //Mostrar la información completa de un número de juego
            $maximoJuego = count($coleccionJuegos) - 1;
            $indiceJuego = solicitarIndiceEntre(0, $maximoJuego);
            $infoJuego = mostrarJuego($coleccionJuegos, $coleccionPalabras, $indiceJuego);
            break;
        case 5: //Mostrar la información completa del primer juego con más puntaje
            $indiceJuego = indiceMayorPunt($coleccionJuegos);
            $infoPrimerJuegoMayorPuntaje = mostrarJuego($coleccionJuegos, $coleccionPalabras, $indiceJuego);
            break;
        case 6: //Mostrar la información completa del primer juego que supere un puntaje indicado por el usuario
            echo "Ingrese una puntuación a superar: ";
            $puntuacion = trim(fgets(STDIN));
            $indice = superarPuntaje($coleccionJuegos, $puntuacion);
            if ($indice == -1) {
                echo "Ningun juego supera la puntuación indicada.\n";
            } else {
                $juegoPuntajeMayorSegunValor = mostrarJuego($coleccionJuegos, $coleccionPalabras, $indice);
            }
            break;
        case 7: //Mostrar la lista de palabras ordenada por orden alfabetico
            $palabrasOrdenadas = ordenarPal($coleccionPalabras);
            print_r($palabrasOrdenadas);
            break;
    }
} while ($opcion != 8);
