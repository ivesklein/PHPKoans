<?php

require_once 'respuestas/respuestas.php';
require_once 'helper/testBase.php';

class ArreglosTest extends testBase
{
    /**
     * @Ejercicio(
    titulo="Largo count() de un arreglo",
    instrucciones="Cuál es el largo del arreglo array(""a"",""b"",""c"") segun count? Responde en la funcion largoDeUnArreglo()"
     * )
     *
     */
    public function testLargoDeUnArreglo(){
        $this->assertCreadaFuncion("largoDeUnArreglo");
        $result = largoDeUnArreglo();
        $this->assertEquals(count(array("a","b","c")),$result,"Ese no es el largo. Cual es el largo del arreglo?");
    }
    /**
     * @Ejercicio(
        titulo="Largo count() de un arreglo multidimencional",
        instrucciones="Cuál es el largo del arreglo array(""a"",""b"",array(""ca"",""cb"",""cd"")) segun count? Responde en la funcion largoDeUnArregloMultiDimensional()",
        conclusion = "Exacto! La función count() cuenta sólo la cantidad de elementos en el primer nivel"
     * )
     *
     */
    public function testLargoDeUnArregloMultiDimensional(){
        $this->assertCreadaFuncion("largoDeUnArregloMultidimencional");

        $result = largoDeUnArregloMultidimencional();
        $this->assertEquals(count(array("a","b",array("ca","cb","cd"))),$result,"Ese no es el largo. Cual es el largo del arreglo?");
    }
    /**
     * @Ejercicio(
     * titulo="Crear tablero 2d",
       instrucciones="Crea una función llamada crearTablero,
    que reciba 2 numeros. Sea $n el primer numero, y $m el segundo numero, devuelve
        un arreglo bidimensional de $n x $m elementos. Llénalo con los valores que quieras."
      )
     */
    public function testCrearTablero(){
        $this->assertCreadaFuncion("crearTablero",2);

        $result = crearTablero(6,3);

        $this->assertTrue(is_array($result),"No retornaste un arreglo");
        $filas=0;
        foreach($result as $res){
            $filas++;
            $columnas=0;
            foreach($res as $r){
                $columnas++;
            }
            $this->assertEquals(3,$columnas,"No pude verificar que el arreglo tenga 6 elementos en cada arreglo interno.");
        }
        $this->assertEquals(6,$filas,"No pude verificar que el arreglo tenga 6 filas.");

    }


    /**
     * @Ejercicio(
     * titulo="Contar elementos de arreglo 2d con condición",
    instrucciones="Crea una función llamada contarTablero,
    que reciba un arreglo de dos dimenciones, no necesariamente cuadrado y cuente todos los valores mayores estrictos que 2 y retorne la suma de todos ellos.
     * (Por ejemplo: array(array(2),array(3,4,10,2),array(3,2),array(3,4)) = 27"
    )
     */
    public function testContarTablero(){
        $this->assertCreadaFuncion("contarTablero",2);

        $result = contarTablero(array(array(2),array(3,4,10,2,5,3),array(3,2),array(3,4)));

        $this->assertEquals(35,$result,"No pude verificar que el valor retornado esté correcto.");


    }

    /**
     * @Ejercicio(
     * titulo="Reversar un arreglo",
    instrucciones="Crea una función llamada <i>reversar</i>,
    que reciba un arreglo y retorne el mismo arreglo pero en orden invertido.
    Por ejemplo: (uno,hola,chao) debe devolver (chao,hola,uno)"
    )
     */
    public function testReversar(){
        $this->assertCreadaFuncion("reversar",1);

        $arreglo = array("perro","casa","arbol");
        $result = reversar($arreglo);
        $this->assertNotNull($result,"Error: La función no retorna nada. Debe retornar un arreglo!");
        $this->assertEquals(true,is_array($result),"Debes retornar un arreglo!");
        $this->assertEquals(array("arbol","casa","perro"),$result,"Los elementos deben retornarse en orden inverso");
    }

    /**
    @Ejercicio(titulo="Numero primo?",
    instrucciones=
    "Crea una función llamada *esPrimo* que tome
    un número como parámetro y retorne verdadero si
    el numero es primo, o falso en caso contrario"
    )
     */
    public function testNumeroPrimo(){
        $this->assertCreadaFuncion('esPrimo',1);
        $this->assertEquals(true,esPrimo(19),"La función retorno una respuesta incorrecta.");
        $this->assertEquals(false,esPrimo(110),"La función retorno una respuesta incorrecta.");
    }


}