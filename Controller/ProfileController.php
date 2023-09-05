<?php

namespace Controller;

use Core\Application;
use Core\Controller;
use Core\Exceptions\ForbiddenException;
use Core\Middlewares\AuthMiddleware;
use Core\Request;
use Core\Response;
use Models\Doctor;
use Models\Manager;
use Models\Section;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profilePatient']));
        $this->registerMiddleware(new AuthMiddleware(['profileDoctor']));
        $this->registerMiddleware(new AuthMiddleware(['profileManager']));
        $this->registerMiddleware(new AuthMiddleware(['profileDoctorEdit']));


        $this->registerMiddleware(new AuthMiddleware(['profileManagerSection']));
        $this->registerMiddleware(new AuthMiddleware(['profileManagerRequestDoctor']));
        $this->registerMiddleware(new AuthMiddleware(['profileManagerRequestManager']));
    }

    public function profilePatient(Request $request, Response $response): false|array|string
    {
        $this->setLayout('inner-patient');

        return $this->render('profile/patient/main');

    }

    public function profileDoctor(Request $request, Response $response): false|array|string
    {
        $this->setLayout('inner-doctor');
        $doctor = new Doctor();
        if ($request->isPost()) {

        }

        return $this->render('profile/doctor/main', [
            'model' => $doctor
        ]);
    }

    public function profileDoctorEdit(Request $request, Response $response): false|array|string
    {
        $this->setLayout('inner-doctor');
        $doctor = new Doctor();
        if ($request->isPost()) {
            $data = $request->getBody();
            $id = Application::$app->user->id;
            $profile_pic = $doctor->profilePic($data['profile_pic'][0], $id);
            $doctor->updata([
                'column' => 'id',
                'value' => Application::$app->user->id
            ],
                ['education' => $data['education'],
                    'medical_code' => $data['medical_code'],
                    'section_id' => $data['section_id'],
                    'profile_pic' => $profile_pic,
                    'address' => $data['address'],
                    'is_completed' => 1
                ]);
        }
        return $this->render('profile/doctor/edit', [
            'model' => $doctor
        ]);
    }

    public function profileManager(Request $request, Response $response): false|array|string
    {
        $this->setLayout('inner-manager');
        return $this->render('profile/manager/main');
    }

    public function profileManagerSection(Request $request, Response $response): false|array|string
    {
        $this->setLayout('inner-manager');
        $section = new Section();
        if ($request->isPost()) {

        }

        return $this->render('profile/manager/section-panel', [
            'model' => $section
        ]);
    }

    public function profileManagerSectionCreate(Request $request, Response $response): false|array|string
    {
        $this->setLayout('inner-manager');
        $section = new Section();
        $data = $request->getBody();
        $section->create($data);
        return $this->render('profile/manager/section-panel', [
            'model' => $section
        ]);
    }

    public function profileManagerSectionDelete(Request $request, Response $response): false|array|string
    {
        $this->setLayout('inner-manager');
        $section = new Section();
        $data = $request->getBody();
        $section->delete($data['delete']);
        return $this->render('profile/manager/section-panel', [
            'model' => $section
        ]);
    }

    public function profileManagerSectionEdit(Request $request, Response $response): false|array|string
    {
        $this->setLayout('inner-manager');
        $section = new Section();
        $data = $request->getBody();
        $id = $data['edit'];
        unset($data['edit']);
        $section->updata(['column' => 'id', 'operation' => '=', 'value' => $id], $data);
        return $this->render('profile/manager/section-panel', [
            'model' => $section
        ]);
    }

    public function profileManagerRequestDoctor(Request $request, Response $response): false|array|string
    {
        $this->setLayout('inner-manager');

        return $this->render('profile/manager/request-doctor');
    }

    public function profileManagerRequestDoctorAccept(Request $request, Response $response): false|array|string
    {
        $doctor = new Doctor();
        $this->setLayout('inner-manager');
        $data = $request->getBody();
        $doctor->updata(['column' => 'id', 'operation' => '=', 'value' => $data['accept']], ['is_active' => 1]);
        return $this->render('profile/manager/request-doctor', [
            'model' => $doctor
        ]);
    }

    public function profileManagerRequestDoctorDecline(Request $request, Response $response): false|array|string
    {
        $doctor = new Doctor();
        $this->setLayout('inner-manager');
        $data = $request->getBody();
        $doctor->updata(['column' => 'id', 'operation' => '=', 'value' => $data['accept']], ['is_active' => 0]);
        return $this->render('profile/manager/request-doctor', [
            'model' => $doctor
        ]);
    }

    public function profileManagerRequestManager(Request $request, Response $response): false|array|string
    {
        $this->setLayout('inner-manager');
        return $this->render('profile/manager/request-manager');
    }

    public function profileManagerRequestManagerAccept(Request $request, Response $response): false|array|string
    {
        $manager = new Manager();
        $this->setLayout('inner-manager');
        $data = $request->getBody();
        $manager->updata(['column' => 'id', 'operation' => '=', 'value' => $data['accept']], ['is_active' => 1]);
        return $this->render('profile/manager/request-manager', [
            'model' => $manager
        ]);


    }

    public function profileManagerRequestManagerDecline(Request $request, Response $response): false|array|string
    {

        $manager = new Manager();
        $this->setLayout('inner-manager');
        $data = $request->getBody();
        $manager->updata(['column' => 'id', 'operation' => '=', 'value' => $data['accept']], ['is_active' => 0]);
        return $this->render('profile/manager/request-manager', [
            'model' => $manager
        ]);
    }

}