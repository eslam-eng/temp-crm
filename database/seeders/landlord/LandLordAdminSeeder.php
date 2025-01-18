<?php

namespace Database\Seeders\landlord;

use App\Models\Landlord\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class LandLordAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::drive('local')
            ->put('admin_password', '');

        $generated_password = env('ADMIN_DEFAULT_PASSWORD', substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHJIKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&'), 0, 10));
        $email = 'admin@isupply.tech';

        User::query()->where('email', $email)->delete();

        $user = User::query()->create(
            [
                'name' => 'CRM Admin',
                'email' => $email,
                'password' => $generated_password,
            ]
        );

        $this->command->info("Admin User With Email $user->email Created, The Generated Password could be found in ".Storage::drive('local')->path('admin_password'));
        Storage::drive('local')->append('admin_password', "$user->email:$generated_password");

    }
}
