<?php

namespace App\Models\Landlord;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Multitenancy\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    protected $fillable = ['domain', 'name', 'database', 'code'];

    protected static function booted(): void
    {
        static::creating(function (self $model) {

            //set database to ulid if empty
            if (empty($model->database)) {
                $model->database = Str::ulid();
            }

            //set domain to database name if empty
            if (empty($model->domain)) {
                $model->domain = $model->database;
            }

            $model->createDatabase();
        });
    }

    public function createDatabase(): bool
    {
        $config = config('database.connections.tenant');
        $create = "CREATE DATABASE IF NOT EXISTS `$this->database`
            DEFAULT CHARACTER SET {$config['charset']}
            DEFAULT COLLATE {$config['collation']}";

        // $user = "CREATE USER IF NOT EXISTS `$this->database`@'%' IDENTIFIED WITH mysql_native_password BY '$this->database'";
        // $privileges = 'ALL';
        //$grant = "GRANT $privileges ON `$this->database`.* TO `$this->database`@'%'";

        return //DB::connection('mysql')->statement($user)
            DB::connection('landlord')->statement($create);
        // && DB::connection('mysql')->statement($grant);
    }
}
