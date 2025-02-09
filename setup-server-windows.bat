@echo off
echo Initializing Database and App Environment...

REM Step 1: Configure PHP (php.ini)
echo [1/10] Configuring App engine...

REM Buat folder logs dan tmp jika belum ada
mkdir "%~dp0bin\php\windows\logs" >nul 2>&1
mkdir "%~dp0bin\php\windows\tmp" >nul 2>&1

REM Salin php.ini-production ke php.ini
copy /y "%~dp0bin\php\windows\php.ini-production" "%~dp0bin\php\windows\php.ini" >nul
if %errorlevel% equ 0 (
    echo Setup engine successfully.
) else (
    echo Failed to setup engine configuration file.
    pause
)

REM Update php.ini dengan setting production
(
    echo date.timezone = Asia/Jakarta
    echo memory_limit = 256M
    echo upload_max_filesize = 64M
    echo post_max_size = 64M
    echo display_errors = Off
    echo display_startup_errors = Off
    echo error_reporting = E_ALL ^& ~E_DEPRECATED ^& ~E_STRICT
    echo log_errors = On
    echo error_log = "%~dp0bin/php/windows/logs/php_errors.log"
    echo session.save_path = "%~dp0binbin/php/windows/tmp"
    echo extension_dir = "%~dp0bin\php\windows\ext"
    echo extension=curl
    echo extension=fileinfo
    echo extension=gd
    echo extension=intl
    echo extension=mbstring
    echo extension=exif
    echo extension=mysqli
    echo extension=openssl
    echo extension=pdo_mysql
    echo extension=xsl
    echo extension=zip
) >> "%~dp0bin\php\windows\php.ini"

REM Step 2: Initialize MySQL Data Directory
echo.
echo [2/10] Initializing Database data directory...

:: Ambil path folder MySQL
set "BASE_DIR_MYSQL=%~dp0bin\mysql\mysql-8.0.30-winx64"
set "BASE_DIR_MYSQL_SLASH=%BASE_DIR_MYSQL:\=/%"

:: Hapus folder data lama jika ada
if exist "%BASE_DIR_MYSQL%\data" (
    rmdir /s /q "%BASE_DIR_MYSQL%\data"
)

:: Buat ulang folder data
mkdir "%BASE_DIR_MYSQL%\data"

:: Jalankan inisialisasi ulang database
"%BASE_DIR_MYSQL%\bin\mysqld" --initialize-insecure --basedir="%BASE_DIR_MYSQL%" --datadir="%BASE_DIR_MYSQL%\data" --console

REM Step 3: Start MySQL Server
echo.
echo [3/10] Configuring Database...
@echo off
setlocal enabledelayedexpansion

:: Buat file my.ini dengan konfigurasi yang sesuai
(
echo [client]
echo port=3306
echo socket=!BASE_DIR_MYSQL_SLASH!/tmp/mysql.sock
echo.
echo [mysqld]
echo port=3306
echo socket=!BASE_DIR_MYSQL_SLASH!/tmp/mysql.sock
echo basedir=!BASE_DIR_MYSQL_SLASH!
echo datadir=!BASE_DIR_MYSQL_SLASH!/data
echo log-error=!BASE_DIR_MYSQL_SLASH!/data/mysql_error.log
echo pid-file=!BASE_DIR_MYSQL_SLASH!/data/mysql.pid
echo key_buffer_size=256M
echo max_allowed_packet=512M
echo table_open_cache=256
echo sort_buffer_size=1M
echo read_buffer_size=1M
echo read_rnd_buffer_size=4M
echo myisam_sort_buffer_size=64M
echo thread_cache_size=8
echo secure-file-priv=""
echo explicit_defaults_for_timestamp=1
echo default_authentication_plugin=mysql_native_password
echo.
echo [mysqldump]
echo quick
echo max_allowed_packet=512M
) > "%BASE_DIR_MYSQL%\my.ini"

REM Step 4: Start MySQL Server
echo.
echo [4/10] Starting Database...
start /b "" "%BASE_DIR_MYSQL%\bin\mysqld" --defaults-file="%BASE_DIR_MYSQL%\my.ini" --console >nul 2>&1
echo Please click Allow if the UAC prompt for MySQLd appears
timeout /t 15 >nul

Step 5: Recreating Database
echo.
echo [5/10] Checking and recreating database...
REM Cek apakah database ada, jika ada maka drop
"%~dp0bin\mysql\mysql-8.0.30-winx64\bin\mysql" -u root -e "DROP DATABASE IF EXISTS amalanramadhan;"
REM Buat database baru
"%~dp0bin\mysql\mysql-8.0.30-winx64\bin\mysql" -u root -e "CREATE DATABASE amalanramadhan;"
if %errorlevel% equ 0 (
    echo Database recreated successfully.
) else (
    echo Failed to recreate database.
    pause
    exit /b 1
)

REM Step 6: Run Laravel Migrations
echo.
echo [6/10] Seeding Database...
cd "%~dp0www"
"..\bin\php\windows\php.exe" artisan migrate:fresh --seed --force
cd ..

REM Step 7: Install Composer Dependencies
echo.
echo [7/10] Installing dependencies part 1 of 2...
cd "%~dp0www"
"..\bin\php\windows\php.exe" "..\bin\composer\composer.phar" install --no-dev --optimize-autoloader
if %errorlevel% equ 0 (
    echo First step dependencies installed successfully.
) else (
    echo Failed to install first step dependencies.
    pause
    exit /b 1
)

REM Step 8: Install Node.js Dependencies
echo.
echo [8/10] Installing dependencies part 2 of 2...
call "%~dp0bin\nodejs\npm.cmd" install
if %errorlevel% equ 0 (
    echo Second step dependencies installed successfully.
) else (
    echo Failed to install second step dependencies.
    pause
    exit /b 1
)

REM Step 9: Build Vite Assets
echo.
echo [9/10] Building App assets...
call "%~dp0bin\nodejs\npm.cmd" run build
if %errorlevel% equ 0 (
    echo App assets built successfully.
) else (
    echo Failed to build App assets.
    pause
    exit /b 1
)

REM Step 10: Clear Laravel Cache
echo.
echo [10/10] Clearing App cache...
"..\bin\php\windows\php.exe" artisan config:clear
"..\bin\php\windows\php.exe" artisan cache:clear
"..\bin\php\windows\php.exe" artisan optimize:clear
cd ..

:: Mematikan server MySQL secara silent
start /b "" "%BASE_DIR_MYSQL%\bin\mysqladmin" -u root shutdown >nul 2>&1

echo Done, If no problem found, You can execute start-server-windows to run the App.
pause
exit