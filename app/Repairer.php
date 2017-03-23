<?php
    namespace App;

    use Illuminate\Database\Eloquent\Model;
    class Repairer extends Model{
         protected $table = 'user';


         protected $fillable = [
            'username', 'password','check','repair_address','status','img','iphone',
         ];
    }