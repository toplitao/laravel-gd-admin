<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    class Repairer extends Model{
         protected $table = 'apply_repair';


         protected $fillable = [
            'username', 'password','check','repairAddress','status','img','iphone',
         ];
    }