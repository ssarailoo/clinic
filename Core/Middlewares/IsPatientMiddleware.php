<?php

namespace Core\Middlewares;

use Core\Application;
use Core\Exceptions\ForbiddenException;

class IsPatientMiddleware extends BaseMiddleware
{
    public array $actions;

    /**
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::getRole() !== 0)
            if (in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
    }

}