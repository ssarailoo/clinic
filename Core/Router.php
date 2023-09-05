<?php

namespace Core;
use Core\Exceptions\NotFoundException;
use Core\Middlewares\BaseMiddleware;

class Router
{
    public array $routes;
    public Response $response;
    public Request $request;

    /**
     * @param Response $response
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->response = $response;
        $this->request = $request;
    }

    public function get(string $path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

//    public function get(string $path, $callback,BaseMiddleware $middleware=null): void
//    {
//        $this->routes['get'][$path] = [
//            'callback'=>$callback,
//            'middleware'=>$middleware
//        ];
//    }
//
//    public function post(string $path, $callback,BaseMiddleware $middleware=null): void
//    {
//        $this->routes['post'][$path] = [
//            'callback'=>$callback,
//            'middleware'=>$middleware
//        ];
//    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? null;
        if (is_null($callback)) {
            $this->response->setStatusCode(404);
            Application::$app->controller = new Controller();

            throw  new NotFoundException();
        }
        if (is_array($callback)) {
            /** @var Controller $controller */
            $controller = new $callback[0];
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;
            foreach ($controller->getMiddlewares() as $middleware) {
                echo"<pre>";
                var_dump($middleware);
                echo"<pre>";

                $middleware->execute();
            }
        }
        return call_user_func($callback, $this->request, $this->response);
    }


}