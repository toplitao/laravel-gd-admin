<?php
    namespace App\Http\Controllers\Information;


    use App\Models\User;
    use App\Http\Controllers\Controller;
    use App\Models\Documentary;
    use Request;
    class DocumentaryController extends Controller{
        public function __construct(){

        }
        public function lists(){
            $user=Documentary::all();
            return $user;
        }
        public function add(){
            $data=Request::all();
            $msg= Documentary::create($data);
            if($msg){
                $ret['status']=1;
                $ret['data']=Documentary::all();
            }else{
                $ret['status']=-1;
                $ret['msg']='增加失败';
            }
            return $ret;
        }
        public function update(){
            $data=Request::all();
            $update=Documentary::find($data['id'])->update($data);
            if($update){
                $ret['status']=1;
                $ret['data']=Documentary::all();
            }else{
                 $ret['status']=-1;
            }
            return $ret;
        }
        public function del(){
            $id=request::input('id');
            if($id){
                $del=Documentary::where('id',$id)->delete();
            }else{
                $ids=request::input('ids');
                $ids=explode(',',$ids);
                $del=Documentary::whereIn('id',$ids)->delete();
            }
            if($del){
                $ret['status']=1;
                $ret['data']=Documentary::all();
                return $ret;
            }

        }
        public function search(){
            $search=Request::all();
            if(isset($search['oid'])){
                 $data=Documentary::where('oid',$search['oid'])->get();
            }else{
                 $data=Documentary::where('uid',$search['uid'])->get();
            }
            return $data;
        }
    }

