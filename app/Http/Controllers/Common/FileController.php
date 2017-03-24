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
        $files_path=[];
        foreach($files as $key => $value){
            $files_path[$key]=$this->upload($value,$id);
        }
        return $this->add($id,$files_path);
    }

    function upload($file,$id){
        $dir_name="img/goods/{$id}/picture";
	    $file_type=$file->guessClientExtension();
	    $file_name = md5($file->getClientOriginalName()).".".$file_type;
		$file_path="http://file.lysh.tech/{$dir_name}/{$file_name}";
        if(!Storage::disk(self::disk)->exists("{$dir_name}/{$file_name}")){
			Storage::disk(self::disk)->put("{$dir_name}/{$file_name}", file_get_contents($file));
		}
        return $file_path;
    }

	function add($id,$files_path){
        $good=Goods::find($id);
        $good->picture=$files_path;
        $good->save();
        return $good;
    }
	// public function postRemoveFile(){
	//     $article = Request::all();
    //     if($article){
	// 		Storage::disk(self::disk)->deleteDirectory("img/article/{$article['id']}/");
	// 	}else{
	// 		return ['error'=>'file remove fiald'];
	// 	}
				
	// }
}