<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fitting extends Model
{
    protected $table = 'fittings';

    protected $fillable = [
        'fittings_name',
        'number',
        'price',
        'content',
    ];


}