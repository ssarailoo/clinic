<?php

namespace Core\Form;

use Core\Model;

class InputField extends BaseField
{
//    public const TYPE_TEXT = 'text';
//    public const TYPE_PASSWORD = 'password';
//    public const TYPE_FILE = 'file';
//
//    public string $type;
//
//
//    public function __construct(Model $model, string $property)
//    {
//        $this->type = self::TYPE_TEXT;
//        parent::__construct($model, $property);
//    }
//
//
//    public function passwordField(): static
//    {
//        $this->type = self::TYPE_PASSWORD;
//        return $this;
//    }
//
//    public function fileField(): static
//    {
//        $this->type = self::TYPE_FILE;
//        return $this;
//    }
//
//    public function renderInput(): string
//    {
//        return sprintf('  <input type="%s" name="%s" value="%s"class="form-control%s">',
//            $this->type,
//            $this->property,
//            $this->model->{$this->property},
//            $this->model->hasError($this->property) ? ' is-invalid' : '',
//        );
//    }
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_FILE = 'file';
    public const TYPE_SELECT = 'select';  // Add a constant for select input.

    public string $type;
    public array $options = [];  // Store select options here.
    public string $keyOfValue='';
    public string $keyOfLabel='';

    public function __construct(Model $model, string $property)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $property);
    }

    public function passwordField(): static
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function fileField(): static
    {
        $this->type = self::TYPE_FILE;
        return $this;
    }


    public function selectOptions(array $options,$keyOfValue,$keyOfLabel): static
    {
        $this->type = self::TYPE_SELECT;
        $this->options = $options;
        $this->keyOfValue=$keyOfValue;
        $this->keyOfLabel=$keyOfLabel;
        return $this;
    }

    public function renderInput(): string
    {
        if ($this->type === self::TYPE_SELECT) {
            return $this->renderSelectInput();
        }

        return sprintf('  <input type="%s" name="%s" value="%s" class="form-control%s">',
            $this->type,
            $this->property,
            $this->model->{$this->property},
            $this->model->hasError($this->property) ? ' is-invalid' : ''
        );
    }


    protected function renderSelectInput(): string
    {
        $optionsHtml = '';

        foreach ($this->options as  $option) {

            $optionsHtml .= sprintf('<option value="%s" >%s</option>', $option->{$this->keyOfValue},$option->{$this->keyOfLabel});

        }

        return sprintf('<select name="%s" class="form-control%s">%s</select>',
            $this->property,
            $this->model->hasError($this->property) ? ' is-invalid' : '',
            $optionsHtml
        );
    }

}
?>

