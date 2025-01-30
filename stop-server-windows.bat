@echo off
echo Stopping App...

:: Ambil path folder MySQL
set "BASE_DIR_MYSQL=%~dp0bin\mysql\mysql-8.0.30-winx64"

REM Stop Laravel server berdasarkan port
for /f "tokens=5" %%a in ('netstat -ano ^| findstr :1722') do (
    taskkill /f /pid %%a >nul 2>&1
)

:: Mematikan server MySQL secara silent
start /b "" "%BASE_DIR_MYSQL%\bin\mysqladmin" -u root shutdown >nul 2>&1

echo App stopped successfully.
pause
exit
