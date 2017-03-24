<?php
namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use Storage;
use App\Models\Goods;

class FileController
{

    const disk = 'sftp';
    public function uploads(Request $request){
        $files = $request->file('files');
        $id = $request->input('id');
        $dir = $request->input('dir');
        $table = $this->getTable($request->input('table'));
        $filed = $request->input('filed');
        $files_path=[];
        foreach($files as $key => $value){
            $files_path[$key]=$this->upload($value,$id,$dir);
        }
        return $this->add($id,$files_path,$table,$filed);
    }

    public function upload($file,$id,$dir_name){
	    $file_type=$file->guessClientExtension();
        if($file_type!='txt'||$file_type!='doc'||$file_type!='docx'||$file_type!='pdf'||$file_type!='xsl'){
	        $file_name = $id.'_'.md5($file->getClientOriginalName()).".".$file_type;
        }else{
            $file_name = $id.'_'.$file->getClientOriginalName().'.'.$file_type;
        }
		$file_path="http://file.lysh.tech/{$dir_name}/{$file_name}";
        if(!Storage::disk(self::disk)->exists("{$dir_name}/{$file_name}")){
			Storage::disk(self::disk)->put("{$dir_name}/{$file_name}", file_get_contents($file));
		}
        return $file_path;
    }

	public function add($id,$files_path,$table,$filed){
        $tableData=$table->find($id);
        $f=$tableData->$filed?:[];
        $tableData->$filed=array_merge($f,$files_path);
        $tableData->save();
        return $tableData;
    }
    public function del($id,$path,$table,$filed){
        $table= new $table();
        $tableData=$table->find($id);
        $_data=$tableData->$filed;
        foreach($_data as $key => $value){
            if($value==$path){
                unset($_data[$key]);
            }
        }
        $data=array_values($_data);
        $tableData->$filed=$data;
        $tableData->save();
        return $tableData;
    }
	public function delete(Request $request){
        $id = $request->input('id');
	    $path = $request->input('path');
        $table = $this->getTable($request->input('table'));
        $filed = $request->input('filed');
        if($path){
			Storage::disk(self::disk)->delete($path);
            return $this->del($id,$path,$table,$filed);
		}else{
			return ['error'=>'file remove fiald'];
		}
				
	}
    function getTable($table){
        if($table=='Goods'){
            return new Goods;
        }
    }
}