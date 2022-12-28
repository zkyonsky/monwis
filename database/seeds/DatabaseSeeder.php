<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(SourcesTableSeeder::class);
        // $this->call(SectionsTableSeeder::class);
        // $this->call(ActivitiesTableSeeder::class);
        // $this->call(RolesTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        $this->call(TrainersTableSeeder::class);
        // $this->call(IkusTableSeeder::class);
        // $this->call(PermissionsTableSeeder::class);
    }
}
