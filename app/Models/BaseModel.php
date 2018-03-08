<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['deleted_at', 'extra'];

    protected function generateWhere(Model $model, array $array)
    {
        foreach ($array as $item)
        {
            $model->where($item[0], $item[1], $item[2]);
        }

        return $model;
    }
}
