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
        //ini kita panggil dia dari sini
        $this->call([
            CampTableSeeder::class,
            CampBenefitTableSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}
