<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $fillable = [
        'module',
        'action',
        'message',
        'stack_trace',
        'status',
        'input',
        'user_id',
        'ip_address',
        'user_agent',
    ];

}
