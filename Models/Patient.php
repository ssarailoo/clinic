<?php

namespace Models;

class Patient extends User
{
    public static function   tableName(): string
    {
        return 'patients';
    }
}