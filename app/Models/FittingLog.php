<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    class FittingLog extends Model{
         protected $table = 'fitting_log';


         protected $fillable = [
            'oid',
            'fid',
            'node',
            'number',
            'type',
            'username',
            'uid',
         ];
    }