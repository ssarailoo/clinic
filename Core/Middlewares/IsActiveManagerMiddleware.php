<?php
namespace Core\Middlewares;
use Core\Application;
use Core\Exceptions\NotActivatedException;


class isActiveManagerMiddleware extends  BaseMiddleware {
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
        if ((!Application::isAccActivated()) && Application::getRole()==2) {
            if (in_array(Application::$app->controller->action, $this->actions)) {
                throw new NotActivatedException();
            }

        }

    }
}