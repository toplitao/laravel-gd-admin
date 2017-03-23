<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    class Repairer extends Model{
         protected $table = 'user';


         protected $fillable = [
            'username', 'password','check','repair_address','status','img','iphone','order_id',
         ];

         public function apply_repair(){
              return $this->hasMany('App\ApplyRepair','user_id','id')->where('status','<','5');
              
         }
    }