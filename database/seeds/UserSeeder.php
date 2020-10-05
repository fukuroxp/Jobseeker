<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\User;
use App\Setting;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = [
            'mail_driver' => 'smtp',
            'mail_host' => 'smtp.gmail.com',
            'mail_port' => 587,
            'mail_from_address' => 'hello@ucc.com',
            'mail_from_name' => 'Unesa Virtual Career Fair',
            'mail_encryption' => 'tls',
            'mail_username' => '',
            'mail_password' => ''
        ];

        Setting::create(['data' => $setting]);

        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'HRD']);
        Role::create(['name' => 'Jobseeker']);

        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('Super Admin');
    }
}
