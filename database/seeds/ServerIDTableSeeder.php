<?php

use Illuminate\Database\Seeder;

class ServerIDTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('server_ids')->insert([
            [
                'server_id'      => 66,
                'server_type'    => 1,
                'server_img_url' => 'http//api.captcha.com',
                'server_api_url' => 'http//api.captcha.com',
                'server_api_weight'=>100,
            ],
        ]);
    }
}
