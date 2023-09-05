<?php


require_once __DIR__ . "/vendor/autoload.php";

use Core\Application;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'hw17',
    'username' => 'root',
    'password' => '',

]);

$capsule->setAsGlobal();

$capsule->bootEloquent();


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];


$app = new Application(__DIR__, $config);

$app->database->applyMigrations();