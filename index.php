<?php
$request = $_GET['url'] ?? '';

$request = rtrim($request, '/');

$confDir = __DIR__ . '/conf';
if (is_dir($confDir)) {
    $confFiles = scandir($confDir);
    foreach ($confFiles as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            require_once $confDir . '/' . $file;
        }
    }
}
$utilsDir = __DIR__ . '/utils';
if (is_dir($utilsDir)) {
    $utilsFiles = scandir($utilsDir);
    foreach ($utilsFiles as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            require_once $utilsDir . '/' . $file;
        }
    }
}

$routes = [
    'api/changepassword' => 'api/ChangePassword.php',
    'api/login' => 'api/Login.php',
    'api/profile' => 'api/Profile.php',
    'api/register' => 'api/Register.php',
    'api/forgotpassword' => 'api/ForgotPassword.php',
];

if (array_key_exists($request, $routes)) {
    require __DIR__ . '/' . $routes[$request];
} else {
    http_response_code(404);
    echo "404 Not Found";
}
?>