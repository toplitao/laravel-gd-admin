<?php
namespace App\Http\Controllers\Common;

use App\Models\SysExpressCompany;
use Request;

class ExpressController
{
    /**
     * @return mixed
     * 模糊查询快递名称
     * 参数 name
     */
    public function search(){
        $name=Request::input('name');
        return SysExpressCompany::where('name','like','%'.$name.'%')->get();
    }

    /**
    * Json方式 查询订单物流轨迹
    */
    function getOrderTracesByJson(){ // 'ShipperCode'=>'required',物流公司代码// 'LogisticCode'=>'required',物流号
        $data=Request::input();
        $data['OrderCode']=$data['OrderCode']??'';
        $requestData= "{'OrderCode':'{$data['OrderCode']}','ShipperCode':'{$data['ShipperCode']}','LogisticCode':'{$data['LogisticCode']}'}";
        $datas = array(
            'EBusinessID' => env('EBusinessID'),
            'RequestType' => '1002',
            'RequestData' => urlencode($requestData),
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, env('AppKey'));

        $result=$this->sendPost('http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx', $datas);

        return $result;
    }
    
    function sendPost($url, $datas) {
        $temps = array();	
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);		
        }	
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if(empty($url_info['port']))
        {
            $url_info['port']=80;	
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader.= "Host:" . $url_info['host'] . "\r\n";
        $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader.= "Connection:close\r\n\r\n";
        $httpheader.= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets.= fread($fd, 128);
        }
        fclose($fd);  
        
        return $gets;
    }
    function encrypt($data, $appkey) {
        return urlencode(base64_encode(md5($data.$appkey)));
    }

}