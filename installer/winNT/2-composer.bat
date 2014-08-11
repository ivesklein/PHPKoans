@ECHO OFF

OPENFILES>NUL 2>&1
IF "%ERRORLEVEL%"=="0" GOTO :OK
GOTO :GetAdmin

:GetAdmin
ECHO.Set UAC = CreateObject^("Shell.Application"^) > "StartAsAdmin.vbs"
ECHO.UAC.ShellExecute "%~fs0", "", "", "runas", 1 >> "StartAsAdmin.vbs"
StartAsAdmin.vbs
DEL "StartAsAdmin.vbs"
EXIT /B

:OK
REM Your code starts here!
php -r "readfile('https://getcomposer.org/installer');" | php
ECHO.
ECHO. COMPOSER INSTALADO NOSE DONDE.
PAUSE>NUL
EXIT