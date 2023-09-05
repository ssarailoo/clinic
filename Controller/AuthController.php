<?php

namespace Controller;

use Core\Application;
use Core\Controller;

use Core\Request;
use Core\Response;

use Models\Doctor;
use Models\LoginForm;
use Models\Manager;
use Models\Patient;
use Models\User;

class AuthController extends Controller
{



    public function login(Request $request): false|array|string
    {
        $this->setLayout('no-nav');
        $data = $request->getBody();
        return $this->render('login');


    }

    public function registerDoctor(Request $request, Response $response): false|array|string
    {
        $doctor = new Doctor();
        $this->setLayout('no-nav');
        if ($request->isPost()) {
            $doctor->loadData($request->getBody());
            if ($doctor->validate() && $doctor->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                $response->redirect('/');
                return $this->render('register/doctor', ['model' => $doctor]);
            }
        }

        return $this->render('register/doctor', ['model' => $doctor]);


    }

    public function registerManager(Request $request, Response $response): false|array|string
    {
        $manager = new Manager();
        $this->setLayout('no-nav');
        if ($request->isPost()) {
            $manager->loadData($request->getBody());
            if ($manager->validate() && $manager->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                $response->redirect('/');
                return $this->render('register/manager', ['model' => $manager]);
            }
        }
        return $this->render('register/manager', ['model' => $manager]);
    }

    public function registerPatient(Request $request, Response $response): false|array|string
    {
        $patient = new Patient();
        $this->setLayout('no-nav');
        if ($request->isPost()) {
            $patient->loadData($request->getBody());
            if ($patient->validate() && $patient->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                $response->redirect('/');
                return $this->render('register/patient', ['model' => $patient]);
            }
        }
        return $this->render('register/patient', ['model' => $patient]);


    }

    public function loginDoctor(Request $request, Response $response): false|array|string
    {
        $this->setLayout('no-nav');
        $loginDoctor = new LoginForm();
        $doctor = new Doctor();

        if ($request->isPost()) {
            $loginDoctor->loadData($request->getBody());
            if ($loginDoctor->validate() && $loginDoctor->login($doctor)) {

                $response->redirect('/');
            }
        }
        return $this->render('login/doctor', ['model' => $loginDoctor]);

    }

    public function loginManager(Request $request, Response $response): false|array|string
    {
        $this->setLayout('no-nav');
        $loginManager = new LoginForm();
        $manager = new Manager();

        if ($request->isPost()) {
            $loginManager->loadData($request->getBody());
            if ($loginManager->validate() && $loginManager->login($manager)) {

                $response->redirect('/');
            }
        }
        return $this->render('login/doctor', ['model' => $loginManager]);

    }

    public function loginPatient(Request $request, Response $response): false|array|string
    {
        $this->setLayout('no-nav');
        $loginPatient = new LoginForm();
        $patient = new Patient();

        if ($request->isPost()) {
            $loginPatient->loadData($request->getBody());
            if ($loginPatient->validate() && $loginPatient->login($patient)) {

                $response->redirect('/');
            }
        }
        return $this->render('login/doctor', ['model' => $loginPatient]);

    }

    public function logout(Request $request, Response $response): void
    {
        Application::$app->logout();
        $response->redirect('/');

    }

}