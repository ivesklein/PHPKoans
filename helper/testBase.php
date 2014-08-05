<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 6/17/14
 * Time: 15:07
 */

class testBase extends PHPUnit_Framework_TestCase{


    function assertCreadaFuncion($nombre,$nparametros=0){
        $exists = function_exists($nombre);
        $this->assertTrue($exists,"La funcion $nombre() no ha sido creada.");
        $refFunc = new ReflectionFunction($nombre);

        $nargs = $refFunc->getNumberOfParameters();
        $this->assertEquals($nparametros,$nargs,"La función $nombre() está creada, pero recibe $nargs parámetros, cuando debería recibir $nparametros.");
    }
} 