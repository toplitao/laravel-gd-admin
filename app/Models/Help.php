<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    class Help extends Model{
         protected $table = 'news';


         protected $fillable = [
            'title', 'author','content',
         ];
    }