@echo off
REM Windows Batch Script to Run Tests

echo.
echo ========================================================
echo           WISATA API - UNIT TEST RUNNER
echo ========================================================
echo.

REM Check if vendor directory exists
if not exist "vendor\autoload.php" (
    echo [ERROR] Vendor directory not found!
    echo Please run: composer install
    exit /b 1
)

echo [INFO] Preparing test environment...
echo.

REM Set environment to testing
set APP_ENV=testing

echo [INFO] Running PHPUnit tests...
echo --------------------------------------------------------
echo.

REM Run PHPUnit
php vendor\bin\phpunit --colors=always --testdox

set EXIT_CODE=%ERRORLEVEL%

echo.
echo --------------------------------------------------------
echo.

if %EXIT_CODE% == 0 (
    echo [SUCCESS] ALL TESTS PASSED!
    echo.
) else (
    echo [FAILED] SOME TESTS FAILED
    echo.
)

echo Test Summary:
echo   Exit Code: %EXIT_CODE%
echo   Run Time: %DATE% %TIME%
echo.

exit /b %EXIT_CODE%
