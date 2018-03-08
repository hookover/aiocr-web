<?php
/**
 * Created by PhpStorm.
 * User: hookover
 * Date: 17-10-16
 * Time: 下午3:38
 */

namespace App\Repositories;


use App\Models\Developer;
use Illuminate\Support\Str;

class DeveloperRepository extends BaseRepository
{
    protected function create($attributes)
    {
        $developer_id  = Developer::orderBy('developer_id', 'desc')->value('developer_id');
        $developer_id  = intval($developer_id) + 1;
        $password_salt = Str::random(32);

        $attributes['api_token']            = $this->getOnlyToken();
        $attributes['api_token_created_at'] = date('Y-m-d H:i:s');
        $attributes['developer_id']     = $developer_id;
        $attributes['salt']             = $password_salt;

//        dd($attributes);

        $attributes = $this->filterNullAttribute($attributes);

        return Developer::create($attributes);
    }

    protected function getOnlyToken()
    {
        while (true) {
            $token = Str::random(64);
            $data  = Developer::select("api_token")->where('api_token', '=', $token)->first();
            if (!$data) {
                return $token;
            }
        }
    }
}