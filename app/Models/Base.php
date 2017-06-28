<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Base extends Model
{

    public function get_by_id($id)
    {
        $data = $this->where('id', $id)->first();
        return $data;
    }
}
