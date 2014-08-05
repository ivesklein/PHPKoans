<?php

require_once 'respuestas/respuestas.php';
require_once 'helper/testBase.php';
class EjemplosTest extends testBase
{
    /**
     * @Ejercicio(
    titulo="Tutorial 1: Primer encuentro, Literal String",
    instrucciones="Tal como te dijimos antes, abre el archivo respuestas.php. Ahí verás un monton de funciones (no te asustes).
        De ahora en adelante no te volveremos a decir que lo abras, por lo que recuerda que debes trabajar ahí para todas las preguntas.
        Despues de cada instrucción verás tambien un tip de qué error encontramos en el código.
        Tu primera tarea es muy simple y consiste en encontrar la funcion ""tutorial1()"" y seguir las instrucciones que verás en el código de la función.
        SI! hay instrucciones EN el código! Welcome to the matrix!
    ",
    conclusion="Gracias! Retornaste un literal de tipo string!  Hello de vuelta!"
    )
     *
     */
    public function testTutorial1(){
        $this->assertCreadaFuncion("tutorial1");
        $this->assertEquals("Hello Adepti!",tutorial1(),"No me has saludado!");

    }
    /**
     * @Ejercicio(
    titulo="Tutorial 2: Cual es tu nombre?",
    instrucciones="Ahora me toca saludarte a ti. Anda a la funcion tutorial2() y retorna tu nombre!
    ",
    conclusion="Muy bien! Retornaste un literal de tipo string!  Ahora solo falta el correo."
    )
     *
     */
    public function testTutorial2(){
        $this->assertCreadaFuncion("tutorial2");
        $this->assertRegExp("/^([a-z]+\s?)+$/i",tutorial2(),"No se como te llamas! Dame solo uno o dos nombres".tutorial3()."?");
    }
    /**
     * @Ejercicio(
    titulo="Tutorial 3: Cual es tu correo?",
    instrucciones="Falta poco, has lo mismo pero ahora en la funcion tutorial3() y retorna tu correo!
    ",
    conclusion="Muy bien! Retornaste un literal de tipo string! Ahora te puedo saludar. Mira la barra que apareció arriba!"
    )
     *
     */
    public function testTutorial3(){
        $this->assertCreadaFuncion("tutorial3");
        $this->assertNotNull(tutorial3(),"Hay que descomentar una linea.");
        $this->assertRegExp("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i",tutorial3(),"Asegurate de entregar un correo válido! Lo usaremos para registrarnos. Retornaste: ".tutorial3());
    }
    /**
     * @Ejercicio(
    titulo="Tutorial 4: Arreglo Literal",
    instrucciones="A veces la respuesta a tu pregunta puede ser más compleja, por ejemplo, devolver un arreglo.
       Siempre te pediremos que dicho arreglo tenga las respuestas en el mismo orden de las preguntas.
       Contesta la pregunta que encontraras dentro de la funcion tutorial4().
    ",
    conclusion="Muy bien! Retornaste un literal de tipo array. Y respondiste dos preguntas en una!"
    )
     *
     */
    public function testTutorial4(){
        $this->assertCreadaFuncion("tutorial4");
        $this->assertNotNull(tutorial4(),"Hay que descomentar una linea.");
        $this->assertEquals(array(10,4),tutorial4(),"Los valores devueltos no coinciden con 10 y 4");
    }
    /**
     * @Ejercicio(
    titulo="Tutorial 5: Variables",
    instrucciones="Anda al tutorial5() y sigue las instrucciones directamente.
    ",
    conclusion="Muy bien! Retornaste una VARIABLE de tipo array. A veces es más fácil ir ordenandose con variables en lugar de retornar todo en una linea!"
    )
     *
     */
    public function testTutorial5(){
        $this->assertCreadaFuncion("tutorial5");
        $this->assertNotNull(tutorial5(),"Hay que descomentar una linea.");
        $this->assertEquals(array(10,4),tutorial5(),"Los valores devueltos no coinciden con 10 y 4");
    }
    /**
     * @Ejercicio(
    titulo="Tutorial 6: Funciones",
    instrucciones="Anda a la funcion tutorial6() y soluciona el problema que te encontrarás.
    ",
    conclusion="Eso es todo el tutorial. Deberías tener claro ahora la diferencia entre comentarios de una linea, y multiples lineas.
       Además deberias saber como retornar variables y literales desde una función."
    )
     *
     */
    public function testTutorial6(){
        $this->assertCreadaFuncion("tutorial6");
        $this->assertNotNull(tutorial6(),"Hay que retornar algo!");
    }

}