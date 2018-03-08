<?php
/**
 * Created by PhpStorm.
 * User: hookover
 * Date: 17-10-16
 * Time: 下午3:38
 */

namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository
{
    protected function create($attributes)
    {
        $user_id       = User::orderBy('user_id', 'desc')->value('user_id');
        $user_id       = intval($user_id) + 1;
        $password_salt = Str::random(32);

        $attributes['api_token']            = $this->getOnlyToken();
        $attributes['api_token_created_at'] = date('Y-m-d H:i:s');
        $attributes['user_id']          = $user_id;
        $attributes['salt']             = $password_salt;

        $attributes = $this->filterNullAttribute($attributes);

        return User::create($attributes);
    }

    protected function getOnlyToken()
    {
        while (true) {
            $token = Str::random(64);
            $data  = User::select("api_token")->where('api_token', '=', $token)->first();
            if (!$data) {
                return $token;
            }
        }
    }

    /**
     * @param $token
     *
     * @return bool|mixed|null
     */
    protected function getUserAllInfoFromCacheByUID($user_id)
    {
        if (!$user_id) {
            return false;
        }

        $user = \Cache::get($this->getEnvCacheKEY($user_id, 'CACHE_KEY_USER_INFO'));

        return $user ? unserialize($user) : null;
    }

    protected function setUserAllInfoToCacheByUID(User $user)
    {
        if ($user->user_id) {
            return \Cache::put($this->getEnvCacheKEY($user->user_id, 'CACHE_KEY_USER_INFO'), serialize($user), env('CACHE_KEY_USER_INFO_TTL', 5));
        }

        return false;
    }

    protected function removeUserAllInfoFromCacheByUID($user_id)
    {
        return \Cache::forget($this->getEnvCacheKEY($user_id, 'CACHE_KEY_USER_INFO'));
    }
}