<?php
    namespace App\Http\Controllers\User;


    use App\Models\User;
    use App\Http\Controllers\Controller;
    use App\Models\Member;
    use Request;
    class MemberController extends Controller{
        public function __construct(){

        }
        public function lists(){
            $user=Member::all();
            return $user;
        }
        public function add(){
            $data=Request::all();
            $msg= Member::create($data);
            if($msg){
                $ret['status']=1;
                $ret['data']=Member::all();
            }else{
                $ret['status']=-1;
                $ret['msg']='增加失败';
            }
            return $ret;
        }
        public function update(){
            $data=Request::all();
            $update=Member::find($data['id'])->update($data);
            if($update){
                $ret['status']=1;
                $ret['data']=Member::all();
            }else{
                 $ret['status']=-1;
            }
            return $ret;
        }
        public function del(){
            $id=request::input('id');
            if($id){
                $del=Member::where('id',$id)->delete();
            }else{
                $ids=request::input('ids');
                $ids=explode(',',$ids);
                $del=Member::whereIn('id',$ids)->delete();
            }
            if($del){
                $ret['status']=1;
                $ret['data']=Member::all();
                return $ret;
            }

        }
        public function search(){
            $search=Request::all();
            if(isset($search['id'])){
                 $data=Member::where('id',$search['id'])->get();
            }else{
                 $data=Member::where('name','like','%'.$search['name'].'%')->get();
            }
            return $data;
        }
    }

