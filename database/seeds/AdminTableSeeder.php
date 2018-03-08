<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'admin_id'    => '88888',
                'email'       => '688977@qq.com',
                'password'    => '44a6ae520b8df21cb9ba3249c8c2414046d9df0d1e4c1e0f04e75604a110dadd',
                'ip_register' => ip2long('192.168.0.1'),
            ],
            [
                'admin_id'    => '88889',
                'email'       => '460306284@qq.com',
                'password'    => '44a6ae520b8df21cb9ba3249c8c2414046d9df0d1e4c1e0f04e75604a110dadd',
                'ip_register' => ip2long('192.168.0.2'),
            ],
        ]);
    }
}
