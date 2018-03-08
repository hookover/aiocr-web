<?php
/**
 * Created by PhpStorm.
 * User: hookover
 * Date: 17-10-16
 * Time: 下午4:09
 */

namespace App\Repositories;


use App\Models\UserLog;
use Illuminate\Http\Request;

class UserLogRepository extends BaseRepository
{
    //写日志
    protected function create(Request $request, $user_id, $status = 0, $desc = '')
    {
        $attributes = [
            'user_id'      => $user_id,
            'type'         => $status,
            'desc'         => $desc,
            'browser_info' => $request->header('User-Agent'),
            'ip'           => ip2long($request->getClientIp()),
        ];

        $attributes = $this->filterNullAttribute($attributes);

        return UserLog::create($attributes);
    }
}