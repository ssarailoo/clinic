<?php

namespace Core\Form;

class TextAreaField extends BaseField
{
    public function renderInput(): string
    {
        return sprintf('<textarea name="%s" class="form-control%s" > %s </textarea>',
            $this->property,
            $this->model->hasError($this->property) ? ' is-invalid ' : '',
            $this->model->{$this->property}

        );
    }


}