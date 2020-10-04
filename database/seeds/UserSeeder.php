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
            'mail_from_name' => 'Unesa Career Center',
            'mail_encryption' => 'tls',
            'mail_username' => '',
            'mail_password' => ''
        ];

        Setting::create(['data' => $setting]);

        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'HRD']);
        Role::create(['name' => 'Jobseeker']);

        $sadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $sadmin->assignRole('Super Admin');

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'adminb@admin.com',
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('Admin');

        $hrd = User::create([
            'name' => 'Hrd',
            'email' => 'hrd@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $hrd->assignRole('HRD');

        $jobseeker = User::create([
            'name' => 'Jobseeker',
            'email' => 'jobseeker@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $jobseeker->assignRole('Jobseeker');

    }
}
