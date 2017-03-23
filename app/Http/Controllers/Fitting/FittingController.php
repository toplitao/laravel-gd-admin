<?php

    namespace App\Http\Controllers\Fitting;

    use Request;
    use App\Fitting;
    use App\Http\Controllers\Controller;
    class FittingController extends Controller{
        public function __construct(){

        }
        public function list(){
            $user=Fitting::all();
            return $user;
        }
        public function add(){
            $data=Request::all();
            $msg= Fitting::create($data);
            if($msg){
                $ret['status']=1;
                $ret['data']=Fitting::all();
            }else{
                $ret['status']=-1;
                $ret['msg']='增加失败';
            }
            return $ret;
        }
        public function update(){
            $data=Request::all();
            $update=Fitting::find($data['id'])->update($data);
            if($update){
                $ret['status']=1;
                $ret['data']=Fitting::all();
            }else{
                 $ret['status']=-1;
            }
            return $ret;
        }
        public function del(){
            $id=request::input('id');
            if($id){
                $del=Fitting::where('id',$id)->delete();
            }else{
                $ids=request::input('ids');
                $ids=explode(',',$ids);
                $del=Fitting::whereIn('id',$ids)->delete();
            }
            if($del){
                $ret['status']=1;
                $ret['data']=Fitting::all();
                return $ret;
            }

        }
        public function search(){
            $search=Request::all();
            if(isset($search['id'])){
                 $data=Fitting::where('id',$search['id'])->get();
            }else{
                 $data=Fitting::where('name','like','%'.$search['name'].'%')->get();
            }
            return $data;
        }
    }

