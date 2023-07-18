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
        $this->call(UsersTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(PackagesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(BusinessTypesTableSeeder::class);
        $this->call(SpotlightDailyTypesTableSeeder::class);
        $this->call(SocialLinkTypeSeeder::class);
        $this->call(OrderStatusTableSeeder::class);
    }
}
