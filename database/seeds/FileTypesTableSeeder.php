<?php

use Illuminate\Database\Seeder;

class FileTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('file_types')->insert([
            [
                'file_type_id' => 10001,
                'cost'         => 20,
                'length'       => 0,
                'name'         => '英文数字1～15字内',
                'description'  => '精度一般',
                'ai_enable'    => 1, //启用自动识别功能
                'status'       => 1, //状态正常
            ],
            [
                'file_type_id' => 10002,
                'cost'         => 10,
                'length'       => 4,
                'name'         => '4位英文',
                'description'  => '精度上等',
                'ai_enable'    => 1, //启用自动识别功能
                'status'       => 1, //状态正常
            ],
            [
                'file_type_id' => 10003,
                'cost'         => 150,
                'length'       => 0,
                'name'         => '10位中文',
                'description'  => '精度一般',
                'ai_enable'    => 1, //启用自动识别功能
                'status'       => 0, //已禁用
            ],
        ]);
    }
}
