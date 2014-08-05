<?php
define('__LLENAR__',"Llename");
function getMetadatosKoan(){
    return array(
        "EjemplosTest"=>array(
            "titulo"=>"Introduccion!",
            "descripcion"=>'
                LEER: Esta seccion tiene una serie de tareas muy simples para que aprendas a usar esta herramienta,
                aprenderás cómo contestar las preguntas metiéndote en el código y terminarás programando como un crack!
                Lo primero que debes hacer es ir a la carpeta respuestas y ver el archivo respuestas.php, ahí escribiras todo el código.
                También tienes un archivo llamado sandbox.php para que hagas correr código arbitrario.

                Suerte!
                ',
            "orden"=>0
        ),
        "ArreglosTest"=>array(
            "titulo"=>"Arreglos!",
            "descripcion"=>"Ejercicios de arreglos.",
            "orden"=>2
        ),
        "FuncionesTest"=>array(
            "titulo"=>"Operadores básicos",
            "descripcion"=>"Un breve repaso de operaciones básicas",
            "orden"=>4
        )
    );

}
function ordenador($a,$b){
    if ($a["orden"] == $b["orden"]) {
        return 0;
    }
    return ($a["orden"] < $b["orden"]) ? -1 : 1;

}