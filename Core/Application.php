<?php

namespace Core;

use Core\Database\Database;
use Models\User;

class Application
{

    public static string $ROOT_DIR;
    public static Application $app;
    public Request $request;
    public Response $response;
    public string $userClass;
    public string $layout = 'main';
    public Router $router;
    public Controller $controller;
    public View $view;
    public Database $database;
    public Session $session;
    public ?User $user;


    public function __construct(string $root, array $config)
    {
        self::$app = $this;
        self::$ROOT_DIR = $root;
        $this->view = new View();
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->database = new Database($config['db']);
        $this->session = new Session();

        $class = $this->session->get('user')[1] ?? '';
        $this->userClass = $this->session->get('user')[1] ?? User::class;
        $primaryValue = $this->session->get('user')[0] ?? '';
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }


    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(User $user, string $class): true
    {

        $this->user = $user;

        $primaryKey = $user::primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', [$primaryValue, $class]);
        return true;
    }

    public function logout(): void
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest(): bool
    {
        return self::$app->user === null;
    }

    public static function getRole(): int
    {
        return self::$app->user->code_role ?? 3;
    }

    public static function docIsCompleted(): bool
    {
        if (self::getRole() == 1)
            return self::$app->user->is_completed == 1;
        return true;
    }

    public static function isAccActivated(): bool
    {
        if (self::getRole() == 1 | 2)
            return self::$app->user->is_active == 1;
        return true;
    }



    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $exception) {
            $this->controller->setLayout('no-nav');
            $this->response->setStatusCode($exception->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $exception
            ]);
        }

    }


}