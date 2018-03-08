<?php
/**
 * Created by PhpStorm.
 * User: hookover
 * Date: 17-10-16
 * Time: 下午3:38
 */

namespace App\Repositories;

use App\Models\File;
use App\Models\ServerID;

class ServerIDRepository extends BaseRepository
{
    protected function getServerIDFromCache($server_id)
    {
        //缓存有么？
        $server = \Cache::get($this->getEnvCacheKEY($server_id, 'CACHE_KEY_SERVER_ID'));
        if ($server) {
            return $server != "\0" ? unserialize($server) : false;
        }

        $server = ServerID::select(["server_id", "server_img_url"])
            ->where(['server_id' => $server_id])
            ->first();

        if ($server) {
            \Cache::put($this->getEnvCacheKEY($server_id, 'CACHE_KEY_SERVER_ID'), serialize($server), env('CACHE_KEY_SERVER_ID_TTL', 120));

            return $server;
        }

        //如果app不存在，就放存个空key
        \Cache::put($this->getEnvCacheKEY($server_id, 'CACHE_KEY_SERVER_ID'), "\0", env('CACHE_KEY_SERVER_ID_TTL', 120));
        return false;
    }


    protected function generateImageUrlByFile(File $file)
    {
        $url    = null;
        $server = $this->getServerIDFromCache($file->server_id);

        if ($server) {
            $url = $server->server_img_url .'/' . env('RECOGNIZE_UPLOAD_PATH') . $file->path;
        }

        return $url;
    }
}