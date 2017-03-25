<?php

namespace App\Http\Controllers\Order;

use App\Models\Repairer;
use Request;
use App\Models\ApplyRepair;
use App\Models\Documentary;
use App\Http\Controllers\Controller;
use Auth;
class OrderController extends Controller{
    public function __construct(){

    }
    public function lists(){
        $user=ApplyRepair::all();
        return $user;
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
    public function readorder(){
        $id=Request::input('id');
        $update['status']=2;
        $boolean=ApplyRepair::find($id)->update($update);
        if($boolean){
            $user=Auth::user();
            $document['oid']=$id;
            $document['charger']=$user['username'];
            $document['status']=2;
            $document['uid']=$user['id'];
            $boolean=Documentary::create($document);
            if($boolean){
                $ret['status']=1;
                $ret['data']=ApplyRepair::all();
            }
             
        }
        return $ret;
    }
    public function selectedrepairer(){
        $data['user_id']=Request::input('uid');
        $repairer=Repairer::find($data['user_id']);
        $data['repairer_name']=$repairer['username'];
        $oid=Request::input('oid');
        $data['status']=3;
        $msg=ApplyRepair::find($oid)->update($data);
        if($msg){
             $user=Auth::user();
             $document['oid']=$oid;
             $document['charger']=$user['username'];
             $document['status']=3;
             $document['uid']=$user['id'];
             $boolean=Documentary::create($document);
            if($boolean){
                $ret['status']=1;
                return $ret;
            }   
        }
    }
}

