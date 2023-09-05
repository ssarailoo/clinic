<?php

namespace Core\Exceptions;

class NotActivatedException extends  \Exception
{
    protected $code=403;
    protected $message = "Your account has not been verified yet ";
}