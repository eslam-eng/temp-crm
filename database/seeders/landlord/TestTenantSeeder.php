<?php

namespace Database\Seeders\landlord;

use App\Models\Landlord\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class TestTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = sprintf('CRM %s', config('app.env'));
        // Your logic to create a new tenant using Spatie multitenancy
        $tenant = Tenant::query()->create([
            'name' => $name,
            'domain' => Str::slug($name),
            'code' => time(),
            'database' => null, //null will create randomly database name
            // Add any other relevant fields as needed
        ]);

        // Switch to the tenant's database
        $tenant->makeCurrent();

        // Migrate the tenant's database
        //php artisan tenants:artisan "migrate --database=tenant --seed"
        $tenant_id = $tenant->id;
        Artisan::call(command: "tenants:artisan --tenant=$tenant_id 'migrate --database=tenant --seed'");

        $tenant->forget();
    }
}
