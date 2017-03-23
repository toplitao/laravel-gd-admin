<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    class Member extends Model{
         protected $table = 'user_info';


         protected $fillable = [
            'name', 'phone','address','email',
         ];
    }