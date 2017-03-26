<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    class Repairer extends Model{
         protected $table = 'user';


         protected $fillable = [
            'username', 'password','level','repair_address','status','img','iphone','sid',
         ];

         public function asd(){
              return $this->hasMany('App\Models\ApplyRepair','user_id','id')->where('status','<','5');
              
         }
    }