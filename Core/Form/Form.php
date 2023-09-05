<?php

namespace Core\Form;

use Core\Model;

class Form
{
    public static function begin(string $action, string $method): Form
    {
        echo sprintf('<form action="%s" method="%s" enctype="multipart/form-data">', $action, $method);
        return new Form();
    }

    public static function end(): string
    {
        return '</form>';

    }

    public function field(Model $model, $property)
    {
return new InputField($model,$property);
    }

}