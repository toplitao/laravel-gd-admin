<?php
    namespace App\Http\Controllers\Order;


    use App\User;
    use App\Http\Controllers\Controller;
    use App\Order;
    use Request;
    class OrderController extends Controller{
        public function __construct(){

        }
        public function list(){
            $user=Order::all();
            return $user;
        }
        public function add(){
            $data=Request::all();
            $msg= Order::create($data);
            if($msg){
                $ret['status']=1;
                $ret['data']=Order::all();
            }else{
                $ret['status']=-1;
                $ret['msg']='增加失败';
            }
            return $ret;
        }
        public function update(){
            $data=Request::all();
            $update=Order::find($data['id'])->update($data);
            if($update){
                $ret['status']=1;
                $ret['data']=Order::all();
            }else{
                 $ret['status']=-1;
            }
            return $ret;
        }
        public function del(){
            $id=request::input('id');
            if($id){
                $del=Order::where('id',$id)->delete();
            }else{
                $ids=request::input('ids');
                $ids=explode(',',$ids);
                $del=Order::whereIn('id',$ids)->delete();
            }
            if($del){
                $ret['status']=1;
                $ret['data']=Order::all();
                return $ret;
            }

        }
        public function search(){
            $search=Request::all();
            if(isset($search['id'])){
                 $data=Order::where('id',$search['id'])->get();
            }else{
                 $data=Order::where('name','like','%'.$search['name'].'%')->get();
            }
            return $data;
        }
    }

