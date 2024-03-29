<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(30)->create();
        \App\Models\Post::factory(30)->create();


        $this->call([
            TagTableSeeder::class,
            SettingTableSeeder::class,
            PermissionTableSeeder::class,
            UserTableSeeder::class,
        ]);
    }
}
