<?php
/**
 * Created by PhpStorm.
 * User: hookover
 * Date: 17-11-2
 * Time: 下午11:23
 */

namespace App\Hashers;
use RuntimeException;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class ShaHasher implements HasherContract
{
    public function make($value, array $options = [])
    {
        $hash =  hash('sha256', $value);

        if ($hash === false) {
            throw new RuntimeException('custom hashing not supported.');
        }

        return $hash;
    }

    public function check($value, $hashedValue, array $options = [])
    {
        return $this->make($value) === $hashedValue;
    }

    public function needsRehash($hashedValue, array $options = [])
    {
        return false;
    }
}