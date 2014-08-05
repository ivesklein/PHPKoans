<?php
/**
 *@Annotation
 */
class Ejercicio
{
    public $titulo;
    public $instrucciones;
    public $ejemplos;
    public $dificultad;
    public $conclusion;
    public $showEchos=false;
    public $dumpOutput=true;
}

/**
 *@Annotation
 */
class Seccion
{
    public $orden;
    public $titulo;
    public $instrucciones;
    public $ejemplos;
    public $dificultad;

}