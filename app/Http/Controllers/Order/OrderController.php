<?php

namespace App\Http\Controllers\Order;

use App\Models\Order;
use Request;
use App\Models\ApplyRepair;
use App\Http\Controllers\Controller;
class OrderController extends Controller{
    public function __construct(){

    }
    public function list(){
        $user=ApplyRepair::all();
        return $user;
    }
    public function add(){
        $data=Request::all();
        $msg= ApplyRepair::create($data);
        if($msg){
            $ret['status']=1;
            $ret['data']=ApplyRepair::all();
        }else{
            $ret['status']=-1;
            $ret['msg']='增加失败';
        }
        return $ret;
    }
    public function update(){
        $data=Request::all();
        $update=ApplyRepair::find($data['id'])->update($data);
        if($update){
            $ret['status']=1;
            $ret['data']=ApplyRepair::all();
        }else{
                $ret['status']=-1;
        }
        return $ret;
    }
    public function del(){
        $id=request::input('id');
        if($id){
            $del=ApplyRepair::where('id',$id)->delete();
        }else{
            $ids=request::input('ids');
            $ids=explode(',',$ids);
            $del=ApplyRepair::whereIn('id',$ids)->delete();
        }
        if($del){
            $ret['status']=1;
            $ret['data']=ApplyRepair::all();
            return $ret;
        }

    }
    public function search(){
        $search=Request::all();
        if(isset($search['id'])){
                $data=ApplyRepair::where('id',$search['id'])->get();
        }else{
                $data=ApplyRepair::where('name','like','%'.$search['name'].'%')->get();
        }
        return $data;
    }
}

