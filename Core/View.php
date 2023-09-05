<?php

namespace Core;

class View
{
public string $title='';
    protected function layoutContent(): false|string
    {


        $layout = Application::$app->controller ? Application::$app->controller->layout : Application::$app->layout;
        ob_start();
        require_once Application::$ROOT_DIR . "/Public/Storage/View/layouts/$layout.php";
        return ob_get_clean();

    }

    protected function renderOnlyContent(string $view, array $params = []): false|string
    {

        foreach ($params as $key => $value)
            $$key = $value;

        ob_start();
        require_once Application::$ROOT_DIR . "/Public/Storage/View/$view.php";
        return ob_get_clean();
    }

    public function renderView(string $view, array $params = []): array|false|string
    {
        return str_replace("{{content}}", $this->renderOnlyContent($view, $params), $this->layoutContent());

    }


}