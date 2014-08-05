PHPKoans
========

Un tutorial inspirado en ruby koans para php


## Instalación

1. Clonar el repositorio. 
2. Descargar composer: https://getcomposer.org/
3. Correr `composer install`
4. Correr en apache con php. Ejemplo: http://localhost/PHPKoans

## Uso

1. Instalar.
2. Editar sólamente el archivo respuestas.php
3. Hacer que todos los tests pasen.

## Instalacion (Para contribuir)

1.  Forkear el repositorio. 
2.  Clonar tu Fork
3. Descargar composer: https://getcomposer.org/
4. En un terminal: ir al proyecto, por ejemplo: `cd PhpKoans` y hacer `composer install`
5. Finalmente, correr en apache con php, por ejemplo con xampp. Ejemplo: `http://localhost/PHPKoans`
6.  Una vez instalado, agregar remote upstream al repo original: `git remote add upstream`
7.  Al hacer cambios pushear al fork.
8.  Para recibir cambios del original hacer pull al upstream.
9.  Para proponer cambios al repositorio hacer pull request.


## Ideas para resolver problemas

1. Verificar que la carpeta bin de php esté en tu path. (Debes poder hacer `php --version` desde consola)

2. Verificar que php tiene permiso para escribir y leer al archivo result.json y out.log

3. Verificar que php tiene permiso y puede ejecutar phpunit (se encontrará en vendor)


## Roadmap

Las prioridades del desarrollo son:

1. Hacer funcionar en windows. No funciona y probablemente es algo relacionado con hacer `exec` al proceso phpunit 
2. Ordenar tests
3. Agregar nuevos tests! :D
