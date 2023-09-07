<?php

namespace Models;

use Core\Database\DbModel;
use Illuminate\Validation\Rule;

abstract class User extends DbModel
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

//    public function rules(): array
//    {
//        return [
//            'firstname' => [self::RULE_REQUIRED],
//            'lastname' => [self::RULE_REQUIRED],
//            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => static::class]],
//            'password' => [self::RULE_REQUIRED, [self::RULE_MIN_LENGTH, 'min' => 4], [self::RULE_MAX, 'max' => 24]],
//            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
//        ];
//    }

    public function rules(): array
    {
        $tableName = static::tablename();

        return [
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => [
                'required',
                'email',
                "unique:mysql.$tableName,email"
            ],
            'password' => ['required', 'min:4', 'max:20'],
            'confirmPassword' => ['required', 'same:password'],
        ];
    }

    public function labels(): array
    {
        return [
            'firstname' => "First Name",
            'lastname' => "Last Name",
            'email' => 'Email',
            'password' => "Password",
            'confirmPassword' => 'Confirm Password'
        ];
    }

    public function attributes(): array
    {
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => password_hash($this->password, PASSWORD_DEFAULT)];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }


}