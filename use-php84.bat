@echo off
echo Setting PHP 8.4 as active version...
set PATH=C:\tools\php84;%PATH%
echo PHP version now active:
php -v
echo.
echo You can now run Composer commands in this window.
echo For example: composer install
echo.
cmd /k