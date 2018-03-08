<?php
/**
 * Created by PhpStorm.
 * User: hookover
 * Date: 17-10-16
 * Time: 下午4:09
 */

namespace App\Repositories;


use App\Models\DeveloperLog;
use Illuminate\Http\Request;

class DeveloperLogRepository extends BaseRepository
{
    //写日志
    protected function create(Request $request, $developer_id, $status = 0, $desc = '')
    {
        $attributes = [
            'developer_id' => $developer_id,
            'type'         => $status,
            'desc'         => $desc,
            'browser_info' => $request->header('User-Agent'),
            'ip'           => ip2long($request->getClientIp()),
        ];

        $attributes = $this->filterNullAttribute($attributes);

        return DeveloperLog::create($attributes);
    }
}