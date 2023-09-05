<?php

namespace Core;
use Core\Middlewares\BaseMiddleware;

class Controller
{

    public string $layout = 'main';
    public string $action='';
    /**
     * @var  BaseMiddleware[]
     */
protected array $middlewares=[];
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function render(string $view ,array $params=[]): false|array|string
    {
       return Application::$app->view->renderView($view,$params);
    }

    public function registerMiddleware(BaseMiddleware $middleware): void
    {
        $this->middlewares[]=$middleware;
    }

    /**
     * @return array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }



}