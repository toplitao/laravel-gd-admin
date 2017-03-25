<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    class Documentary extends Model{
         protected $table = 'documentary';


         protected $fillable = [
            'oid',
            'charger',
            'status',
            'uid',
         ];
    }