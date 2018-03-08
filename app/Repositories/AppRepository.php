<?php
/**
 * Created by PhpStorm.
 * User: hookover
 * Date: 17-10-16
 * Time: 下午3:38
 */

namespace App\Repositories;

use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppRepository extends BaseRepository
{
    protected function create(Request $request)
    {
        $app_id = App::max('app_id');
        $app_id = intval($app_id) + 1;

        $attributes = [
            'app_id'               => $app_id,
            'app_key'              => Str::random(32),
            'developer_id'         => $request->user()->developer_id,
            'name'                 => $request->input('app_name'),
            'status'               => App::STATUS_VALID,
            'developer_id_created' => $request->user()->developer_id,
            'ip'                   => $request->getClientIp(),
        ];

        return App::create($attributes);
    }
}