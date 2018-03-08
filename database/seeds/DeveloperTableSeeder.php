<?php

use Illuminate\Database\Seeder;

class DeveloperTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('developers')->insert([
            [
                'developer_id'           => 219818,
                'email'                  => '688977@qq.com',
                'username'               => 'hookover',
                'phone'                  => '15310911801',
                'point_pay_current'      => 100000,
                'point_dividend_current' => 100000,
                'password'               => '44a6ae520b8df21cb9ba3249c8c2414046d9df0d1e4c1e0f04e75604a110dadd',
                'salt'                   => 'ACzLhJNd8RxRqYSsablCPtLgRtgLUxmv',
                'api_token'                  => 'E5acio1dnks4XYiySZkkLZbJP4W5Q4h8n2qU1DLjNPmUULvXccrLUhUrgSz3xVEL',
                'api_token_created_at'       => '2017-08-08 08:08:08',
                'ip_register'            => ip2long('192.168.0.1'),
            ],
            [
                'developer_id'           => 219819,
                'email'                  => '460306284@qq.com',
                'username'               => '460306284',
                'phone'                  => '18696010322',
                'point_pay_current'      => 100000,
                'point_dividend_current' => 100000,
                'password'               => '44a6ae520b8df21cb9ba3249c8c2414046d9df0d1e4c1e0f04e75604a110dadd',
                'salt'                   => 'ACzLhJNd8RxRqYSsablCPtLgRtgLUxmv',
                'api_token'                  => 'E5acio1dnks4XYiySZkkLZbJP4W5Q4h8n2qU1DLjNPmUULvXccrLUhUrgSz3xVEi',
                'api_token_created_at'       => '2017-08-08 08:08:08',
                'ip_register'            => ip2long('192.168.0.1'),
            ],
        ]);
    }
}
