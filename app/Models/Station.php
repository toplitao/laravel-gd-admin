<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    class Station extends Model{
         protected $table = 'station';


         protected $fillable = [
            'station_name', 'phone','station_charger','work_img',
         ];
    }