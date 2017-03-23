<?php
    namespace App;

    use Illuminate\Database\Eloquent\Model;
    class Fitting extends Model{
         protected $table = 'fittings';


         protected $fillable = [
            'fittings_name', 'number','price',
         ];
    }