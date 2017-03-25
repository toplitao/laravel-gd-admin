<?php
    namespace App\Http\Controllers\Interactive;


    use App\Models\User;
    use App\Http\Controllers\Controller;
    use App\Models\Help;
    use Request;
    class HelpController extends Controller{
        public function __construct(){

        }
        public function lists(){
            $user=Help::all();
            return $user;
        }
        public function add(){
            $data=Request::all();
            $msg= Help::create($data);
            if($msg){
                $ret['status']=1;
                $ret['data']=Help::all();
            }else{
                $ret['status']=-1;
                $ret['msg']='增加失败';
            }
            return $ret;
        }
        public function update(){
            $data=Request::all();
            $update=Help::find($data['id'])->update($data);
            if($update){
                $ret['status']=1;
                $ret['data']=Help::all();
            }else{
                 $ret['status']=-1;
            }
            return $ret;
        }
        public function del(){
            $id=request::input('id');
            if($id){
                $del=Help::where('id',$id)->delete();
            }else{
                $ids=request::input('ids');
                $ids=explode(',',$ids);
                $del=Help::whereIn('id',$ids)->delete();
            }
            if($del){
                $ret['status']=1;
                $ret['data']=Help::all();
                return $ret;
            }

        }
        public function search(){
            $search=Request::all();
            if(isset($search['id'])){
                 $data=Help::where('id',$search['id'])->get();
            }else{
                 $data=Help::where('name','like','%'.$search['name'].'%')->get();
            }
            return $data;
        }
    }

