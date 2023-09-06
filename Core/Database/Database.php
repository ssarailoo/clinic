<?php

namespace Core\Database;


use Core\Application;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use PDO;

class Database
{
    public PDO $pdo;


    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public function insertInto(string $table, array $attributes): void
    {
        Capsule::table($table)->insert($attributes);
    }
    public function delete(string $table,string|int $id): void
    {
        Capsule::table($table)->delete($id);
    }

    public function update(string $table, array $where, array $data): void
    {
        Capsule::table($table)->where($where['column'], $where['value'])->update($data);
    }


    public function all(string $table, string $column = '*'): array
    {
        return Capsule::table($table)->select($column)->get()->toArray();
    }

    public function isUnique(string $table, string $uniqueProperty, string $dataFromPost): bool
    {
        $record = Capsule::table($table)->select()->where($uniqueProperty, $dataFromPost)->first();
        return !isset($record);
    }

    public function select($table, array $where = [],string $column='*')
    {

        return Capsule::table($table)->where($where['column'], $where['operation'], $where['value'])->select($column)->first()->$column?? '';

    }


    public function applyMigrations(): void
    {
        $this->createMigrationTable();
        $AppliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/migrations');
        $files = array_slice($files, 2);
        $toApplyMigrations = array_diff($files, $AppliedMigrations);

        foreach ($toApplyMigrations as $migration) {
            require_once Application::$ROOT_DIR . "/migrations/$migration";
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className;
            $this->log(" Applying migration " . $migration);
            $instance->up();
            $this->log(" Applied migration " . $migration);
            $newMigrations[] = $migration;
        }
        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else
            echo "All migrations are applied";


    }


    public function createMigrationTable(): void
    {
        if (!Capsule::schema()->hasTable('migrations')) {
            Capsule::schema()->create('migrations', function (Blueprint $table) {
                $table->id();
                $table->string('migration', '255');
                $table->timestamp('created_at');

            });
        }
    }

    public function getAppliedMigrations(): array
    {
        return Capsule::table('migrations')->pluck('migration')->toArray();
    }

    public function saveMigrations(array $migrations): void
    {
//        $migrations = implode(',',array_map(fn($m) => "('$m')", $migrations));
        foreach ($migrations as $migration)
            Capsule::table('migrations')->insert(['migration' => $migration]);
    }

    protected function log(string $message): void
    {
        echo '[' . date('Y-m-d H:i:s') . ']' . $message . PHP_EOL;
    }


}