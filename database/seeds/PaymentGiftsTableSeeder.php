<?php

use Illuminate\Database\Seeder;

class PaymentGiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_gifts')->insert([
            [//满100送2
                'condition_money' => 100,
                'gift_money'      => 2,
                'type'            => \App\Models\PaymentGift::TYPE_ALL,
                'status'          => \App\Models\PaymentGift::STATUS_ENABLED,
                'expiration'      => null,
            ],
            [//满500送20
                'condition_money' => 500,
                'gift_money'      => 15,
                'type'            => \App\Models\PaymentGift::TYPE_ALL,
                'status'          => \App\Models\PaymentGift::STATUS_ENABLED,
                'expiration'      => null,
            ],
            [//满1000送50
             'condition_money' => 1000,
             'gift_money'      => 50,
             'type'            => \App\Models\PaymentGift::TYPE_ALL,
             'status'          => \App\Models\PaymentGift::STATUS_ENABLED,
             'expiration'      => null,
            ],
            [//满5000送500
             'condition_money' => 5000,
             'gift_money'      => 350,
             'type'            => \App\Models\PaymentGift::TYPE_ALL,
             'status'          => \App\Models\PaymentGift::STATUS_ENABLED,
             'expiration'      => null,
            ],
            [//满10000送1000
             'condition_money' => 10000,
             'gift_money'      => 1000,
             'type'            => \App\Models\PaymentGift::TYPE_ALL,
             'status'          => \App\Models\PaymentGift::STATUS_ENABLED,
             'expiration'      => null,
            ],
            [//满50000送1000
             'condition_money' => 50000,
             'gift_money'      => 6000,
             'type'            => \App\Models\PaymentGift::TYPE_DEVELOPER,
             'status'          => \App\Models\PaymentGift::STATUS_ENABLED,
             'expiration'      => null,
            ],
            [//满100000送20000
             'condition_money' => 100000,
             'gift_money'      => 20000,
             'type'            => \App\Models\PaymentGift::TYPE_DEVELOPER,
             'status'          => \App\Models\PaymentGift::STATUS_ENABLED,
             'expiration'      => null,
            ],
        ]);
    }
}
