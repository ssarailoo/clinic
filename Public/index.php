<?php

use Controller\AuthController;
use Controller\ProfileController;
use Controller\SiteController;
use Core\Application;
use Models\Doctor;
use Models\Manager;
use Models\Patient;
use Models\User;

define('ROOT_DIR', dirname(__DIR__));
require_once ROOT_DIR . '/vendor/autoload.php';
require_once "../config.php";

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_DIR);
$dotenv->load();
$config = [
    'userClass' => [
        Doctor::class => Doctor::class,
        Patient::class => Patient::class,
        Manager::class => Manager::class,
    ],
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];


$app = new Application(ROOT_DIR, $config);
$app->router->get("/", [SiteController::class, 'home']);
$app->router->get("/contact", [SiteController::class, 'contact']);
$app->router->post("/contact", [SiteController::class, 'contact']);
$app->router->get("/register-doctor", [AuthController::class, 'registerDoctor']);
$app->router->post("/register-doctor", [AuthController::class, 'registerDoctor']);
$app->router->get("/register-manager", [AuthController::class, 'registerManager']);
$app->router->post("/register-manager", [AuthController::class, 'registerManager']);
$app->router->get("/register-patient", [AuthController::class, 'registerPatient']);
$app->router->post("/register-patient", [AuthController::class, 'registerPatient']);
$app->router->get("/login-doctor", [AuthController::class, 'loginDoctor']);
$app->router->post("/login-doctor", [AuthController::class, 'loginDoctor']);
$app->router->get("/login-manager", [AuthController::class, 'loginManager']);
$app->router->post("/login-manager", [AuthController::class, 'loginManager']);
$app->router->get("/login-patient", [AuthController::class, 'loginPatient']);
$app->router->post("/login-patient", [AuthController::class, 'loginPatient']);
$app->router->get("/profile-patient", [ProfileController::class, 'profilePatient']);
$app->router->post("/profile-patient", [ProfileController::class, 'profilePatient']);
$app->router->get("/profile-doctor", [ProfileController::class, 'profileDoctor']);
$app->router->post("/profile-doctor", [ProfileController::class, 'profileDoctor']);
$app->router->get("/profile-doctor-edit", [ProfileController::class, 'profileDoctorEdit']);
$app->router->post("/profile-doctor-edit", [ProfileController::class, 'profileDoctorEdit']);
$app->router->get("/profile-doctor-appointment", [ProfileController::class, 'profileDoctorAppointment']);
$app->router->post("/profile-doctor-appointment", [ProfileController::class, 'profileDoctorAppointment']);
$app->router->get("/profile-manager", [ProfileController::class, 'profileManager']);
$app->router->post("/profile-manager", [ProfileController::class, 'profileManager']);
$app->router->get("/profile-manager-section-panel", [ProfileController::class, 'profileManagerSection']);
$app->router->post("/profile-manager-section-panel-create", [ProfileController::class, 'profileManagerSectionCreate']);
$app->router->get("/profile-manager-section-panel-create", [ProfileController::class, 'profileManagerSectionCreate']);
$app->router->post("/profile-manager-section-panel-delete", [ProfileController::class, 'profileManagerSectionDelete']);
$app->router->post("/profile-manager-section-panel-edit", [ProfileController::class, 'profileManagerSectionEdit']);
$app->router->get("/profile-manager-request-doctor", [ProfileController::class, 'profileManagerRequestDoctor']);
$app->router->post("/profile-manager-request-doctor-accept", [ProfileController::class, 'profileManagerRequestDoctorAccept']);
$app->router->get("/profile-manager-request-doctor-accept", [ProfileController::class, 'profileManagerRequestDoctorAccept']);
$app->router->post("/profile-manager-request-doctor-decline", [ProfileController::class, 'profileManagerRequestDoctorDecline']);
$app->router->get("/profile-manager-request-doctor-decline", [ProfileController::class, 'profileManagerRequestDoctorDecline']);
$app->router->get("/profile-manager-request-manager", [ProfileController::class, 'profileManagerRequestManager']);
$app->router->post("/profile-manager-request-manager-accept", [ProfileController::class, 'profileManagerRequestManagerAccept']);
$app->router->get("/profile-manager-request-manager-accept", [ProfileController::class, 'profileManagerRequestManagerAccept']);
$app->router->get("/profile-manager-request-manager-decline", [ProfileController::class, 'profileManagerRequestManagerDecline']);
$app->router->post("/profile-manager-request-manager-decline", [ProfileController::class, 'profileManagerRequestManagerDecline']);
$app->router->get("/logout", [AuthController::class, 'logout']);




$app->run();


?>