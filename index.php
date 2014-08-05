<?php
ob_start();
require 'vendor/autoload.php';
require 'respuestas/respuestas.php';
require 'tests/metadatos.php';
require_once 'tests/annotations.php';
include_once 'tests/arreglosTest.php';
include_once 'tests/ejemplosTest.php';
include_once 'tests/operadoresTest.php';
use Doctrine\Common\Annotations\AnnotationReader;
$suite  = new PHPUnit_Framework_TestSuite("StringTest");
$output = "";
$metadatos = getMetadatosKoan();
$outval=1;
exec('php vendor/bin/phpunit --verbose --log-json result.json tests/ > out.log',$outval);

$fixed = '['.str_replace('}{','},{',file_get_contents("result.json")).']';
$results = json_decode('['.str_replace('}{','},{',file_get_contents("result.json")).']',true);
$secciones = array();
$count = 1000;
$seccionindex=0;
$fallos=0;

ob_start();
$sandbox = ob_get_clean();
$annotationReader = new AnnotationReader();
/*
 * Primer procesamiento de resultados de tests.
 * Se guardarán a un arreglo (secciones)
 */
foreach ($results as $result) {
    // Si hay meta datos para el nombre del testSuite
    if(isset($metadatos[$result["suite"]])){
        // Y aun no está creada su seccion en el arreglo
        if(!isset($secciones[$result["suite"]])){

            // Se crea la seccion para el test suite
            $secciones[$result["suite"]] = array();

            // Se define la variable orden según existan metadatos que lo dijan o no
            if(isset($metadatos[$result["suite"]]["orden"])){
                $secciones[$result["suite"]]["orden"]= $metadatos[$result["suite"]]["orden"];
            }else{
                $secciones[$result["suite"]]["orden"]= $count;
            }

            $secciones[$result["suite"]]["id"]=$result["suite"];
            $secciones[$result["suite"]]["titulo"]=$metadatos[$result["suite"]]["titulo"];
            $secciones[$result["suite"]]["descripcion"]=$metadatos[$result["suite"]]["descripcion"];
        }
    }else{
        continue;
    }
    if($result["event"]=="suiteStart"){
        $secciones[$result["suite"]]["tests"]=0;
        $secciones[$result["suite"]]["listos"]=0;
        $secciones[$result["suite"]]["progress"]=0;
        $secciones[$result["suite"]]["ejercicios"]=array();
    }else if($result["event"]=="test"){
        $testData = explode("::",$result["test"]);
        // Method Annotations
        $reflectionMethod = new ReflectionMethod($testData[0], $testData[1]);
        $methodAnnotations = $annotationReader->getMethodAnnotations($reflectionMethod);
        foreach($methodAnnotations as $annotation){
            if(get_class($annotation)=='Ejercicio'){
                $secciones[$result["suite"]]["tests"]++;

                $listos = $secciones[$result["suite"]]["listos"];

                $secciones[$result["suite"]]["ejercicios"][]=array(
                    "titulo"=>$annotation->titulo,
                    "instrucciones"=>$annotation->instrucciones,
                    "ejemplos"=>$annotation->ejemplos,
                    "dificultad"=>$annotation->dificultad,
                    "conclusion"=>$annotation->conclusion,
                    "status"=>$result["status"],
                    "completado"=>$result["status"]=="pass"?true:false,
                    "trace"     => $result["trace"],
                    "mensaje" => strtok($result["message"],"\n")
                );
                if($result["status"]=="pass"){
                    $secciones[$result["suite"]]["listos"]++;
                }

            }
        }
    }
}

usort($secciones,'ordenador');
$out = ob_get_clean();

$fallos=0;
$temaindex=0;
$nombre=false;
$seccionesFiltradas = array();

$filtrarSecciones=false;
$filtrarEjercicios=false;

$nombre = function_exists("getNombreAlumno")?getNombreAlumno():"Anonimo";
$correo = function_exists("getCorreoAlumno")?getCorreoAlumno():false;
$puntos = 0;
$ultimoEjercicio=false;
$hechos= array();
foreach($secciones as $key=>$seccion){
    $seccionesFiltradas[$key]=$seccion;
    $seccionesFiltradas[$key]["completado"]=false;
    $seccionesFiltradas[$key]["progress"]=$seccionesFiltradas[$key]["tests"]>0?100.0*$seccionesFiltradas[$key]["listos"]/$seccionesFiltradas[$key]["tests"]:0;
    $seccionesFiltradas[$key]["ejercicios"] =array();

    foreach($seccion["ejercicios"] as $key2=>$ejercicio){
        $seccionesFiltradas[$key]["ejercicios"][$key2]=$ejercicio;
        if(!$ejercicio["completado"]){
            $fallos++;
            if(!$ultimoEjercicio){
                $ultimoEjercicio=array("seccion"=>$seccion["id"],"numero"=>$key2+1,"titulo"=>$ejercicio["titulo"],"instrucciones"=>$ejercicio["instrucciones"]);
            }
            if($filtrarEjercicios){
                break;
            }
        }else{
            $hechos[]=array("seccion"=>$seccion["id"],"numero"=>$key2+1,"titulo"=>$ejercicio["titulo"]);
            $puntos++;
        }
    }
    if($fallos==0){
        $seccionesFiltradas[$key]["completado"]=true;
    }else{
        if($filtrarSecciones){
            break;
        }
    }

    $temaindex++;
}
$jsonInfo=array("hechos"=>$hechos,"ultimoEjercicio"=>$ultimoEjercicio,"puntos"=>$puntos);
$jsonInfo=json_encode($jsonInfo);
$filradasJson = json_encode($seccionesFiltradas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Adepti PHP Koans</title>
    <link href="css/bootstrap.min.vivachile.css" rel="stylesheet">
    <style>.nav, .pagination, .carousel, .panel-title a { cursor: pointer; }</style>
</head>
<body ng-app="myApp" ng-controller="MainCtrl">
<div ng-show="name" class="navbar navbar-default">
        <img class="navbar-brand" src="img/chile.png"></img>

    <ul class="nav navbar-nav">
        <li>
            <a href="#/">Adepti Php Koans</a>
        </li>
    </ul>
    <div class="navbar-right">
        <p class="navbar-text">

            Hola {{name}} ( {{email}} ).
        </p>
    </div>
</div>
<div ng-view></div>
<script type="text/ng-template" id="home.html">
<h1 class="text-center">Adepti PHP Koans</h1>

    <section ng-repeat="seccion in misSecciones">
        <h1> {{seccion.titulo}}
                <a ng-show="seccion.completado" class="btn btn-success">
                    Terminado
                </a>
            <div class="progress">
                <div class="progress-bar" style="width: {{seccion.progress}}%;">
                    {{seccion.listos}}/{{seccion.tests}}
                </div>
            </div>
        </h1>
        <div id="{{seccion.id}}">
            <div class="alert alert-info">
                <p>{{seccion.descripcion}} (Total: {{seccion.tests}})
            </div>
                <div ng-class="{alert:true,'alert-success':ejercicio.completado,'alert-info':!ejercicio.completado}" ng-repeat="(key,ejercicio) in seccion.ejercicios">
                    <div class="pull-right">
                        Usuarios aqui: <span>{{usuariosEn(ejercicio)}}</span>
                    </div>
                    <h2>{{key+1}}) {{ejercicio.titulo}}</h2>
                    <p>{{ejercicio.instrucciones}}</p>
                    <p class="alert alert-danger" ng-show="ejercicio.mensaje">Tip: {{ejercicio.mensaje}}</p>
                    <p class="alert alert-success" ng-show="ejercicio.completado&&ejercicio.conclusion">{{ejercicio.conclusion}}</p>
                </div>
        </div>
    </section>
    <div>
    <ul>
        <li ng-repeat="user in allUsers|filter:connections">
            {{user}}
        </li>
    </ul>
    </div>
</script>

<section>
    <h2>Salidas</h2>
    <p>(Todos los "echo" que hagas en respuestas.php o sus includes, o errores extraños que generes apareceran aquí):</p>
     <?php echo $out; ?>
</section>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.1.min.js"></script>
<script type='text/javascript' src="js/angular.min.js"></script>
<script type='text/javascript' src="js/angular-route.min.js"></script>
<script type='text/javascript' src="js/ui-bootstrap.min.js"></script>


<script>
    window.filtradasJson = <?php echo $filradasJson;?>;
</script>
<script>
    var app = angular.module("myApp",["ngRoute",'ui.bootstrap']);
    app.config(['$routeProvider', function($routeProvider) {
        $routeProvider
            .when('/', {
                templateUrl: "home.html",
                controller: "HomeCtrl"
            })
    }]);
    app.controller("HomeCtrl",function($scope){
    })
    app.controller("MainCtrl",function($scope){
        $scope.avanceList = [];
        $scope.misSecciones = window.filtradasJson;

    });
</script>
</body>
</html>