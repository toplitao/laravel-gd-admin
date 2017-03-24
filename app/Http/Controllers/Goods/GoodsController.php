<?php
    namespace App\Http\Controllers\Goods;


    use App\Models\User;
    use App\Http\Controllers\Controller;
    use App\Models\Goods;
    use Request;
    class GoodsController extends Controller{
        public function __construct(){

        }
        public function lists(){
            $user=Goods::all();
            return $user;
        }
        public function add(){
            $data=Request::all();
            $msg= Goods::create($data);
            if($msg){
                $ret['status']=1;
                $ret['data']=Goods::all();
            }else{
                $ret['status']=-1;
                $ret['msg']='增加失败';
            }
            return $ret;
        }
        public function update(){
            $data=Request::all();
            $update=Goods::find($data['id'])->update($data);
            if($update){
                $ret['status']=1;
                $ret['data']=Goods::all();
            }else{
                 $ret['status']=-1;
            }
            return $ret;
        }
        public function del(){
            $id=request::input('id');
            if($id){
                $del=Goods::where('id',$id)->delete();
            }else{
                $ids=request::input('ids');
                $ids=explode(',',$ids);
                $del=Goods::whereIn('id',$ids)->delete();
            }
            if($del){
                $ret['status']=1;
                $ret['data']=Goods::all();
                return $ret;
            }

        }
        public function search(){
            $search=Request::all();
            if(isset($search['id'])){
                 $data=Goods::where('id',$search['id'])->get();
            }else{
                 $data=Goods::where('name','like','%'.$search['name'].'%')->get();
            }
            return $data;
        }
    }

