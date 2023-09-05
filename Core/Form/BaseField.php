<?php

namespace Core\Form;

use Core\Model;

abstract class BaseField
{
    public Model $model;
    public string $property;

    /**
     * @param Model $model
     * @param string $property
     */
    public function __construct(Model $model, string $property)
    {

        $this->model = $model;
        $this->property = $property;
    }

    abstract public function renderInput(): string;

    public function __toString(): string
    {
        return sprintf(
            '<div class="form-group">
                        <label>%s</label>
                     %s
                        <div class="invalid-feedback">
                          %s
                          </div>
                     </div>',
            $this->model->getLabel($this->property)
            , $this->renderInput(),
            $this->model->getFirstError($this->property));
    }


}