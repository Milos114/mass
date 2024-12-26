<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Loggable;

    protected $guarded = [];
}
