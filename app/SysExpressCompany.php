<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class SysExpressCompany extends Model
{
    protected $table = 'sys_express_company';

    protected $fillable = [
        'id',
        'name',
        'code',
    ];

    public $timestamps = false;


}