<?php

namespace Models;

class Manager extends User
{
    public static function   tableName(): string
    {
        return 'managers';
    }

}