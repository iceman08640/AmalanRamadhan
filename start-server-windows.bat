@echo off
echo Starting app...

:: Ambil path folder MySQL
set "BASE_DIR_MYSQL=%~dp0bin\mysql\mysql-8.0.30-winx64"

start /b "" "%BASE_DIR_MYSQL%\bin\mysqld" --defaults-file="%BASE_DIR_MYSQL%\my.ini" --console >nul 2>&1
timeout /t 5 >nul

REM Start Laravel server
start /b bin\php\windows\php.exe www\artisan serve --port=1722

echo App started successfully.