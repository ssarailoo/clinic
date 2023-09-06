<?php


namespace Core;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_MIN_LENGTH = 'min';
    public const RULE_MAX_LENGTH = 'max';
    public const RULE_MATCHES = 'matches';
    public const RULE_UNIQUE = 'unique';
    public const RULE_EMAIL = 'email';
    public const RULE_SIZE = 'size';

    public abstract function rules(): array;

    public array $errors = [];

    public function loadData(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key))
                $this->{$key} = $value;
        }
    }

    public function labels(): array
    {
        return [];
    }

    public function getLabel(string $property)
    {
        return $this->labels()[$property] ?? $property;
    }

//    public function validate(): bool
//    {
//
//        foreach ($this->rules() as $property => $rules) {
//            $value = $this->{$property};
//            foreach ($rules as $rule) {
//                $ruleName = $rule;
//                if (is_array($rule)) {
//                    $ruleName = $rule[0];
//                }
//                if ($ruleName === self::RULE_REQUIRED && !$value) {
//                    $this->addErrorForRule($property, self::RULE_REQUIRED);
//                }
//                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
//                    $this->addErrorForRule($property, self::RULE_EMAIL);
//                }
//                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
//                    $this->addErrorForRule($property, self::RULE_MAX, $rule);
//                }
//                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
//                    $this->addErrorForRule($property, self::RULE_MIN, $rule);
//                }
//                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
//                    $rule['match']=$this->getLabel($rule['match']);
//                    $this->addErrorForRule($property, self::RULE_MATCH, $rule);
//                }
//
//                if ($ruleName === self::RULE_UNIQUE) {
//                    $className = $rule['class'];
//                    $uniqueProperty = $rule['property'] ?? $property;
//                    $tableName=$className::tablename();
//                   if (!Application::$app->database->isUnique($tableName,$uniqueProperty,$value))
//                    $this->addErrorForRule($property, self::RULE_UNIQUE, ['field'=>$this->getLabel($property)]);
//
//                }
//            }
//
//
//        }
//        return empty($this->errors);
//
//    }
    public function validate(): bool
    {
        $data = [];
        $rules = [];

        foreach ($this->rules() as $property => $rulesArray) {
            $data[$property] = $this->{$property};
            $rules[$property] = $rulesArray;
        }


        $validator = getValidator($data, $rules, $this->errorMessages());




        if ($validator->fails()) {
            $this->errors = $validator->errors()->toArray();
            return false;
        }

        return true;
    }


    private function addErrorForRule(string $property, string $ruleName, $params = []): void
    {
        $message = $this->errorMessages()[$ruleName] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }

        $this->errors[$property][] = $message;
    }


    private function errorMessages(): array
    {
//        return [
//            self::RULE_REQUIRED => 'The :attribute field is required.',
//            self::RULE_UNIQUE => 'A record with this :attribute already exists.',
//            self::RULE_MAX_LENGTH => 'The :attribute may not be greater than :max characters.',
//            self::RULE_MIN_LENGTH => 'The :attribute must be at least :min characters.',
//            self::RULE_MATCHES=> 'The :attribute must match the :other field.',
//            self::RULE_SIZE => 'The :attribute must not be greater than :size.'
//        ];
        return $messages = [
            'required' => 'The :attribute field is required.',
            'min' => 'The :attribute must be at least :min characters.',
            'max' => 'The :attribute may not be greater than :max characters.',
            'email' => 'The :attribute must be a valid email address.',
            'unique' => 'The has already been taken.',
            'same' => 'The :attribute and :other must match.',
        ];
    }

    public function addError(string $property, string $message): void
    {
        $this->errors[$property][] = $message;
    }

    public function hasError($property)
    {
        return $this->errors[$property] ?? false;
    }

    public function getFirstError($property)
    {
        return $this->errors[$property][0] ?? '';
    }

}