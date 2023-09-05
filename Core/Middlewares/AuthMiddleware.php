<?php

namespace Core\Middlewares;

use Core\Application;
use Core\Exceptions\ForbiddenException;
use Core\Exceptions\NotActivatedException;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions;

    /**
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute(): void
    {

//        if (Application::getRole() === 0 && (
//                str_contains(Application::$app->request->getPath(), '/profile-doctor')
//                ||
//                str_contains(Application::$app->request->getPath(), '/profile-manager'))
//        ) {
//            throw new ForbiddenException();
//        }
//        if (Application::getRole() === 1 && (
//                str_contains(Application::$app->request->getPath(), '/profile-patient')
//                ||
//                str_contains(Application::$app->request->getPath(), '/profile-manager'))
//        ) {
//            throw new ForbiddenException();
//        }
//        if (Application::getRole() === 2 && (
//                str_contains(Application::$app->request->getPath(), '/profile-patient')
//                ||
//                str_contains(Application::$app->request->getPath(), '/profile-doctor'))
//        ) {
//            throw new ForbiddenException();
//
//        }


        if (Application::isGuest()) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }


}