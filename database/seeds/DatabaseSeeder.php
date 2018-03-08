<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserTableSeeder');

        $this->call('AdminTableSeeder');

        $this->call('DeveloperTableSeeder');

        $this->call('AppTableSeeder');

        $this->call('FileTypesTableSeeder');

        $this->call('CardTableSeeder');

        $this->call('PaymentGiftsTableSeeder');

        $this->call('ServerIDTableSeeder');
    }
}
