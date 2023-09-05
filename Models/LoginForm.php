<?php

namespace Models;

use Core\Application;
use Core\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]];

    }

    public function login(User $user)
    {
        $user = $user::findOne(['email'=>$this->email]);

        if (!$user) {
            $this->addError('email', 'User does not exists with this email');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {

            $this->addError('password', 'Password is incorrect');
            return false;
        }

        return Application::$app->login($user,$user::class);

    }

    public function labels(): array
    {
        return ['email' => 'Your Email', 'password' => 'Password'];
    }


}