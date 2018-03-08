<?php

use Illuminate\Database\Seeder;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer = \App\Models\Developer::first();
        DB::table('apps')->insert([
            [
                'app_id'               => 105601,
                'developer_id'         => $developer->developer_id,
                'name'                 => '系统软件',
                'app_key'              => 'gik9eQlzt4OB1aqy8pfP4ZFlmIzupAM7',
                'status'               => 1,
                'developer_id_created' => $developer->developer_id,
                'ip'                   => '127.0.0.1',
            ],
        ]);
    }
}
