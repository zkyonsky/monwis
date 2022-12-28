<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //permission for inputs
        Permission::create(['name' => 'inputs.index']);
        Permission::create(['name' => 'inputs.create']);
        Permission::create(['name' => 'inputs.edit']);
        Permission::create(['name' => 'inputs.delete']);
        Permission::create(['name' => 'inputs.show']);

        //permission for spmks
        Permission::create(['name' => 'spmks.index']);
        Permission::create(['name' => 'spmks.edit']);
        Permission::create(['name' => 'spmks.show']);
        Permission::create(['name' => 'spmks.download']);
        Permission::create(['name' => 'spmks.upload']);

        //permission for monitors
        Permission::create(['name' => 'monitors.index']);
        Permission::create(['name' => 'monitors.agenda']);

        //permission for ikus
        Permission::create(['name' => 'ikus.index']);
        Permission::create(['name' => 'ikus.detail']);

        //permission for extrajps
        Permission::create(['name' => 'extrajps.index']);
        Permission::create(['name' => 'extrajps.detail']);

        //permission for profiles
        Permission::create(['name' => 'profiles.index']);

        //permission for trainers
        Permission::create(['name' => 'trainers.index']);
        Permission::create(['name' => 'trainers.create']);
        Permission::create(['name' => 'trainers.edit']);
        Permission::create(['name' => 'trainers.delete']);

        //permission for codes
        Permission::create(['name' => 'codes.index']);
        Permission::create(['name' => 'codes.create']);
        Permission::create(['name' => 'codes.edit']);
        Permission::create(['name' => 'codes.delete']);

        //permission for permissions
        Permission::create(['name' => 'permissions.index']);

        //permission for users
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);
        Permission::create(['name' => 'users.changestatus']);

        //permission for roles
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.delete']);
    }
}
