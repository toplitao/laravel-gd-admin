<?php
    namespace App\Http\Controllers\Information;


    use App\Models\User;
    use App\Http\Controllers\Controller;
    use App\Models\Station;
    use Request;
    class StationController extends Controller{
        public function __construct(){

        }
        public function lists(){
            $user=Station::all();
            return $user;
        }
        public function add(){
            $data=Request::all();
            $msg= Station::create($data);
            if($msg){
                $ret['status']=1;
                $ret['data']=Station::all();
            }else{
                $ret['status']=-1;
                $ret['msg']='增加失败';
            }
            return $ret;
        }
        public function update(){
            $data=Request::all();
            $update=Station::find($data['id'])->update($data);
            if($update){
                $ret['status']=1;
                $ret['data']=Station::all();
            }else{
                 $ret['status']=-1;
            }
            return $ret;
        }
        public function del(){
            $id=request::input('id');
            if($id){
                $del=Station::where('id',$id)->delete();
            }else{
                $ids=request::input('ids');
                $ids=explode(',',$ids);
                $del=Station::whereIn('id',$ids)->delete();
            }
            if($del){
                $ret['status']=1;
                $ret['data']=Station::all();
                return $ret;
            }

        }
        public function search(){
            $search=Request::all();
            if(isset($search['id'])){
                 $data=Station::where('id',$search['id'])->get();
            }else{
                 $data=Station::where('name','like','%'.$search['name'].'%')->get();
            }
            return $data;
        }
    }

