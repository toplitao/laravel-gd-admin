<?php
    namespace App\Http\Controllers\User;


    use App\Http\Controllers\Controller;
    use App\Models\Repairer;
    use Request;
    class RepairerController extends Controller{
        public function __construct(){

        }
        public function lists(){
            $user=Repairer::all();
            return $user;
        }
        public function add(){
            $data=Request::all();
            $msg= Repairer::create($data);
            if($msg){
                $ret['status']=1;
                $ret['data']=Repairer::all();
            }else{
                $ret['status']=-1;
                $ret['msg']='增加失败';
            }
            return $ret;
        }
        public function update(){
            $data=Request::all();
            $update=Repairer::find($data['id'])->update($data);
            if($update){
                $ret['status']=1;
                $ret['data']=Repairer::all();
            }else{
                 $ret['status']=-1;
            }
            return $ret;
        }
        public function del(){
            $id=request::input('id');
            if($id){
                $del=Repairer::where('id',$id)->delete();
            }else{
                $ids=request::input('ids');
                $ids=explode(',',$ids);
                $del=Repairer::whereIn('id',$ids)->delete();
            }
            if($del){
                $ret['status']=1;
                $ret['data']=Repairer::all();
                return $ret;
            }

        }
        public function search(){
            $search=Request::all();
            if(isset($search['id'])){
                 $data=Repairer::where('id',$search['id'])->get();
            }else{
                 $data=Repairer::where('name','like','%'.$search['name'].'%')->get();
            }
            return $data;
        }
        public function distribution(){
            $data=Repairer::with('apply_repair')->get();
            return $data;
        }
    }

