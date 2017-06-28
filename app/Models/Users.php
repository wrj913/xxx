<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    protected $table = 'users';

    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name', 'tel', 'password','update_time','create_time',
    ];

    public function add($data)
    {
        return $this->insertGetId($data);
    }
}
