<?php

    namespace App\Http\Controllers\Fitting;

    use Request;
    use App\Models\Fitting;
    use App\Models\FittingLog;
    use App\Http\Controllers\Controller;
    use Auth;
    class FittingController extends Controller{
        public function __construct(){

        }
        public function lists(){
            $user=Fitting::all();
            return $user;
        }
        public function add(){
            $data=Request::all();
            $msg= Fitting::create($data);
            if($msg){
                $ret['status']=1;
                $ret['data']=Fitting::all();
                $addinfo=Fitting::where('fittings_name',$data['fittings_name'])
                ->where('number',$data['number'])
                ->where('price',$data['price'])->first()->toArray();//$a['data']=$addinfo;return $a;
                $log['fid']=$addinfo['id'];
                $log['node']="新增配件(进库)";
                $log['number']=$addinfo['number'];
                $log['type']=1;
                $user=Auth::user();
                $log['username']=$user['username'];
                $log['uid']=$user['id'];
                $msg=FittingLog::create($log);
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
        public function fittinglog(){
            $fid=Request::input('id');
            $data=FittingLog::where('fid',$fid)->get();
            if(count($data)){
                $ret['status']=1;
                $ret['data']=$data;
            }else{
                $ret['status']=-1;
                $ret['msg']='无记录';
            }
            return $ret;
        }
    }

