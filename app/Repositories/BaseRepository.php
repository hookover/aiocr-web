<?php
/**
 * Created by PhpStorm.
 * User: hookover
 * Date: 17-10-16
 * Time: 下午4:09
 */

namespace App\Repositories;


class BaseRepository
{
    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

    public function getCurrentClassNameCacheKey($key)
    {
        return str_replace('\\', '.', get_class($this)) . '.' . $key;
    }

    public function filterNullAttribute(array $attributes = [])
    {
        return array_filter($attributes, function ($attr) {
            return $attr ? true : false;
        });
    }

    public function getEnvCacheKEY($suffix_key, $env_key)
    {
        $env_key = env($env_key);
        return $env_key ? $env_key . $suffix_key : $this->getCurrentClassNameCacheKey($suffix_key);
    }
}