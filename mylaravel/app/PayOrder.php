<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PayOrder extends Model
{
    use SoftDeletes;
    protected $table = 'pay_order';
}
