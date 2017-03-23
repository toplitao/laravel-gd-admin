<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    class ApplyRepair extends Model{
         protected $table = 'apply_repair';


         protected $fillable = [
            'uid',
            'goods_type',
            'buy_time',
            'problem',
            'customer_name',
            'tel_number',
            'address',
            'picture',
            'status',
            'order_number',
            'back_number',
            'input_time',
            'lat',
            'lng',
            'rid',
         ];
    }