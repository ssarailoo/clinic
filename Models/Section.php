<?php

namespace Models;

use Core\Application;
use Core\Database\DbModel;

class Section extends DbModel
{
    public string $id = '';
    public string $name = '';

    public static function tableName(): string
    {
        return 'sections';
    }

    public function attributes(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return ['name' => [self::RULE_REQUIRED]];
    }

    public function labels(): array
    {
        return [
            'name' => "Section Name"
        ];
    }

    public function create(array $data): void
    {
        unset($data['create']);
        $this->insert($data);
    }


}