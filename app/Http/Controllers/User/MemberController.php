<?php
    namespace App\Http\Controllers\User;


    use App\User;
    use App\Http\Controllers\Controller;
    class MemberController extends Controller{
        public function __construct(){

        }
        public function list(){
            $msg=['ret'=>'成功'];
            return $msg;
        }
    }
?>
