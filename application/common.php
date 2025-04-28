<?php


//字符转换
//type = 1表示字符转编码
function _String($string,$type = 1){
	if($type==1){
		$string = str_replace('"',"&quot;",$string);
	}else{
		$string = str_replace('&quot;','"',$string);
	}
	return $string;
}

function _Json($data = array()){
	echo json_encode($data);
	exit;
}

function _RandStr($length = 8){
	$str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$len = strlen($str)-1;
	$randstr = '';
	for ($i=0;$i<$length;$i++) {
		$num=mt_rand(0,$len);
		$randstr .= $str[$num];
	}
	return $randstr;
}


function _geturl($url,$code = 0){
	
	$preg = "/^http(s)?:\\/\\/.+/";
	$ssl = "http";
	if(preg_match($preg,$url)){
		$ssl = "https";
	}else{
		$ssl = "http";
	}
	$curl  =  curl_init();  //初始化
	curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');  //在HTTP请求中包含一个”User-Agent: “头的字符串。
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30); //在发起连接前等待的时间，如果设置为0，则无限等待。
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);  //设置cURL允许执行的最长秒数。
	curl_setopt($curl , CURLOPT_URL , $url);  //设置抓取的url
	curl_setopt($curl , CURLOPT_HEADER ,0);  //设置头文件的信息作为数据流输出
	curl_setopt($curl , CURLOPT_RETURNTRANSFER ,1);  //设置获取的信息以文件流的形式返回，而不是直接输出。

	if ($ssl == "https") {
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
	}
	$data  =  curl_exec($curl);   //执行命令
	$httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE); //返回状态码
	curl_close($curl);  //关闭URL请求
     //显示获得的数据
	if($code == 0){
		return $data;
	}else{
		return $httpCode;
	}
}

//域名处理，分割域名
function domain($domain){
	$domains = array();
	$domain = str_replace("www.","",$domain);
	$domain = explode(".",$domain);
	$count  = count($domain);
	$domains[0] = $domain[0];
	if($count == 2){
		$domains[1] = $domain[1];
	}elseif($count == 3){
		$domains[1] = $domain[1].".".$domain[2];
	}elseif($count == 4){
		$domains[1] = $domain[1].".".$domain[2].".".$domain[3];
	}
	return $domains;
}
?>