<?php

namespace Database\Seeders;

use Database\Seeders\landlord\LandLordAdminSeeder;
use Database\Seeders\landlord\TestTenantSeeder;
use Illuminate\Database\Seeder;
use Spatie\Multitenancy\Models\Tenant;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Tenant::checkCurrent()
            ? $this->runTenantSpecificSeeders()
            : $this->runLandlordSpecificSeeders();
    }

    public function runTenantSpecificSeeders()
    {
        // run tenant specific seeders
    }

    public function runLandlordSpecificSeeders()
    {
        $this->call(LandLordAdminSeeder::class);
        $this->call(TestTenantSeeder::class);
    }
}
