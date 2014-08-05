<?php

require_once 'respuestas/respuestas.php';
require_once 'helper/testBase.php';

class FuncionesTest extends testBase
{
    /**
    @Ejercicio(titulo="El concatenador",
    instrucciones=
    "Has que la función concatena($a,$b) retorne ambos valores concatenados y separados por una ""y"" y espacios.
     Por ejemplo, para $a=perro y $b=gato, debe retornar ""perro y gato""
      "
    )
     */
    public function testOperadorConcatenador(){
        $this->assertCreadaFuncion('concatenarY',2);
        $this->assertEquals("Cerveza y goles",concatenarY("Cerveza","goles"),"El valor está mal concatenado. No olvides los espacios");
    }


    /**
    @Ejercicio(titulo="Calcular resto?",
    instrucciones=
    "Mira la función calcularResto($a,$b), repárala. Qué es lo que le falta?"
    )
     */
    public function testComparador(){
        $this->assertCreadaFuncion('calcularResto',2);
        $this->assertEquals(0,calcularResto(10,5),"La función retorno una respuesta incorrecta.");
        $this->assertEquals(3,calcularResto(33,10),"La función retorno una respuesta incorrecta.");
    }
}