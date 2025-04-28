<?php
namespace app\group\controller;
use think\Controller;
use think\Session;
use think\Request;
use think\Db;
use think\Config;

class Index extends Controller{

	public function _initialize(){
		Config::load(CONF_PATH.'extra/ip.php');
		$domain = config('ip');
		$dodomain = $_SERVER['HTTP_HOST'];
		if($domain == $dodomain){
			exit("Error：无法使用管理级别域名作为炮灰域名!");
		}
	}
	
	
	//用于微信原生支付查询订单装态
	public function wxselect()
	{
	    $id = input('id');
	    $orderid = input('orderid');
	    $back_url =  'http://'.$_SERVER['HTTP_HOST']."/group.php/index/share/id/".$id."/";
	    $ok_url =  'http://'.$_SERVER['HTTP_HOST']."/group.php/index/successok/id/".$id."/";
	    $bill = Db("bill")->where("bl_sncode = '{$orderid}'")->find();
	    if(!empty($bill)){
	        if($bill['bl_status'] == 2){
	            //支付成功
	            $res['status'] = 1;
			    $res['msg']    = $ok_url;
			    return _Json($res);
	        }
	    }else{
	        //订单不存在
	        $res['status'] = 2;
			$res['msg']    = $back_url;
			return _Json($res);
	    }
	}
	
	
	//微信原生支付
	public function wxpay()
	{
	    $appid = input('appid');
	    $appsecret = input('appsecret');
	    $mchid = input('mchid');
	    $appsc = input('apikey');
	    //$money = input('money');
	    //$title = input('title');
	    $orderid = input('orderid');
	    $id = input("id");
	    $wxginfo = Db("wxgroup")->where("wxg_id = {$id}")->find();
	   
	    import('paylist.payweixin.pay');
		$classname = "Pay_payweixin";
		$PayModel = new $classname;
		
		$PayModel->config = array(
            'appid'      => $appid,
            'appsecret'  => $appsecret,
            'mch_id'     => $mchid,
            'pay_apikey' => $appsc
        );
        
       
        $back_url =  'http://'.$_SERVER['HTTP_HOST']."/group.php/index/share/id/".$id."/";
  
		//通过code获得openid
		if (!isset($_GET['code'])){//触发微信返回code码
			$baseUrl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING']);
			$url = $PayModel->_CreateOauthUrlForCode($baseUrl);
			Header("Location: $url");
			exit();
		} else {
		    
			//获取code码，以获取openid
		    $code = $_GET['code'];
			$openid = $PayModel->getOpenidFromMp($code);
			if(empty($openid)){
			    echo "OPENID不存在，请重新配置授权信息";
			    //Header("Location: $back_url");
			    exit;
			}
            $result = $PayModel->wxpay($openid,$wxginfo['wxg_money'],$wxginfo['wxg_title'],$orderid);
            $url =  url('index/wxselect');
            
echo '<html><head><meta http-equiv="content-type" content="text/html;charset=utf-8"/><meta name="viewport" content="width=device-width, initial-scale=1"/> <title></title><script src="https://s3.pstatp.com/cdn/expire-1-M/jquery/3.3.1/jquery.min.js"></script></head><script type="text/javascript">
    
    setTimeout(function(){ 
        jsApiCall();
    },500);
    
    setInterval(function(){ 
		$.ajax({
			type:"POST",
			url:"'.$url.'",
			dataType:"json",
			data:{
				orderid:"'.$orderid.'",
				id:'.$id.',
			},
			success:function(res){
				if(res.status == 1){
				    window.location.href = res.msg;
				}else if(res.status == 2){
				    window.location.href = res.msg;
				}
			},
			error:function(jqXHR){
				console.log("Error: "+jqXHR.status);
			},
		});
    },1000);

	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			\'getBrandWCPayRequest\',
			'.$result.',
			function(res){
				WeixinJSBridge.log(res.err_msg);
			    if(res.err_msg == "get_brand_wcpay_request:ok"){  
				    alert("支付成功!");
			    }else if(res.err_msg == "get_brand_wcpay_request:cancel"){  
				    window.location.href = "'.$back_url.'";
				    //alert("用户取消支付!");
			    }else{  
			        window.location.href = "'.$back_url.'";
				    //alert("支付失败!");  
			    }  
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener(\'WeixinJSBridgeReady\', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent(\'WeixinJSBridgeReady\', jsApiCall); 
		        document.attachEvent(\'onWeixinJSBridgeReady\', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	
	</script><body></body></html>';
		}
       
	}
	
	//调用支付功能
	public function paylist()
	{
		$id = input('id');
		if(Request::instance()->isAjax()){
			
			//查出支付信息
			$wxginfo = Db("wxgroup")->where("wxg_id = {$id}")->find();
			if($wxginfo['wxg_paylists'] == "" or empty($wxginfo['wxg_paylists'])){
			    $sinfo = Db("substation_paylist")
			    ->alias("spl")
			    ->join("__PAYLIST__ pl","pl.pl_id = spl.pl_id")
			    ->where("spl.su_id = {$wxginfo['su_id']} and spl.su_pl_status = 1 and pl.pl_status = 1")
			    ->select();
			}else{
			    $array = explode(",",$wxginfo['wxg_paylists']);
			    $array = array_filter($array);
			    $ids    = implode(",",$array);
			    $sinfo = Db("substation_paylist")
			    ->alias("spl")
			    ->join("__PAYLIST__ pl","pl.pl_id = spl.pl_id")
			    ->where("spl.su_id = {$wxginfo['su_id']} and spl.su_pl_status = 1 and pl.pl_status = 1 and spl.su_pl_id in ({$ids})")
			    ->select();
			}
			$rand_count = array_rand($sinfo,1);
			
			//查出分销比例
			$dinfo = Db("distribution")->alias("d")->join("__DISTRIBUTION_GROUP__ dg","d.dg_id = dg.dg_id")->where("d.du_id = ".$wxginfo['du_id'])->find();
			
			//生成订单
			$scalemoney      = $wxginfo['wxg_money'] * ($dinfo['dg_count']/100);
			$substationmoney = $wxginfo['wxg_money'] - $scalemoney;
			$sncode          = $dinfo['su_id']."_".$id."_".time();
			$resinfo = Db("bill")->where("bl_sncode = '{$sncode}' and su_id = {$dinfo['su_id']} and wxg_id = {$id}")->find();
			if(empty($resinfo)){
    			$add_date = [
    				'du_id'              => $wxginfo['du_id'],
    				'su_id'              => $wxginfo['su_id'],
    				'wxg_id'             => $id,
    				'su_pl_id'           => $sinfo[$rand_count]['su_pl_id'],
    				'bl_sncode'          => $sncode,
    				'bl_money'           => $wxginfo['wxg_money'],
    				'bl_addtime'         => date("Y-m-d H:i:s"),
    				'bl_status'          => 1,
    				'bl_scale'           => $dinfo['dg_count'],
    				'bl_scalemoney'      => $scalemoney, //实拿金额
    				'bl_substationmoney' => $substationmoney, //平台赢利金额
    			];
    			$res = Db("bill")->insertGetId($add_date);
			}else{
			    $res = $resinfo['bl_id'];
			}
			if($res){
				//查出分站信息取分站域名
				$subinfo = Db("substation")->where("su_id = ".$wxginfo['su_id'])->find();
				$payname = $sinfo[$rand_count]['pl_code'];
				import('paylist.'.trim($payname).'.pay');
				$classname = "Pay_".$payname;
				$PayModel = new $classname;
				$PayModel->orderid = $sncode;
				$PayModel->money   = $wxginfo['wxg_money'];
				$PayModel->title   = $wxginfo['wxg_title'];
				$PayModel->wxgid   = $id;
				$PayModel->domain  = $subinfo['su_domain'];
				$PayModel->dates   = $sinfo[$rand_count];
				session("orderid",$sncode);
				$times = time() + 86400;
	            session('times',$times);
				return $PayModel->index();
			}else{
				$res['status'] = 0;
				$res['msg']    = "生成订单出错！";
				return _Json($res);
			}
		}
	}
	
	//回调数据
	public function notify()
	{
	   //$
		$id      = input('id');
		$type    = "paydongtai";
		$orderid = input('out_trade_no');
		//sss= file_get_contents("php://input");
	    //file_put_contents("111123.txt",$orderid);
		if(empty($orderid)){
		    $orderid = input('orderid');
		    $type = "payxunhu";
		}
		
		$data = [
			'bl_status'    => 2,
			'bl_zfaddtime' => date("Y-m-d H:i:s"),
		];
		$res = Db("bill")->where("bl_sncode = '{$orderid}' and bl_status = 1")->update($data);
		if($res){ //如果更新成功，就给用户增加点数
			$binfo = Db("bill")->where("bl_sncode = '{$orderid}'")->find();
			$dinfo = Db("wxgroup")->alias("wxg")->join("__DISTRIBUTION__ d","d.du_id = wxg.du_id")->where("wxg_id = ".$binfo['wxg_id'])->find();
			$money = $binfo['bl_scalemoney'] + $dinfo['du_money'];
			$udata = [
				'du_money' => $money,
			];
			Db("distribution")->where("du_id = ".$dinfo['du_id'])->update($udata);
			
			//1记录扣点信息 2扣除用户身上点卡
			//计算扣费计录
			$substation_info = Db("substation")->where("su_id = ".$binfo['su_id'])->find();
			if($substation_info['su_dk_cd'] > 0){
    			$dk_money = $binfo['bl_money'] * ($substation_info['su_dk_cd']/100); //扣费记录
    			$in_money = $substation_info['su_dk'] - $dk_money;
    			$data_dk = [
    			    'dkl_money'   => $dk_money,
    			    'dkl_addtime' => date("Y-m-d H:i:s"),
    			    'su_id'       => $binfo['su_id'],
    			    'bl_id'       => $binfo['bl_id'],
    			    'dkl_su_id'   => $substation_info['su_s_id'],
    		    ];
    		    
    		    Db("dianka_log")->insertGetId($data_dk);
    		    $data_user = [
    			    'su_dk'   => $in_money,
    		    ];
    		    Db("substation")->where("su_id = ".$binfo['su_id'])->update($data_user);
			}
			//记录扣点信息
			
			//二级分站处理，记录扣点信息
			/*
			1.判断是不是有上级
			*/
			if($substation_info['su_s_id'] != 0){
			    $substation_info_s = Db("substation")->where("su_id = ".$substation_info['su_s_id'])->find();
			    if($substation_info_s['su_dk_cd'] > 0){
        			$dk_money = $binfo['bl_money'] * ($substation_info_s['su_dk_cd']/100); //扣费记录
        			$in_money = $in_money - $dk_money;
        			$data_dk = [
        			    'dkl_money'   => $dk_money,
        			    'dkl_addtime' => date("Y-m-d H:i:s"),
        			    'su_id'       => $binfo['su_id'],
        			    'bl_id'       => $binfo['bl_id'],
        			    'dkl_su_id'   => 0,
        		    ];
        		    
        		    Db("dianka_log")->insertGetId($data_dk);
        		    $data_user = [
        			    'su_dk'   => $in_money,
        		    ];
        		    Db("substation")->where("su_id = ".$binfo['su_id'])->update($data_user);
        		    //上级站点分红抽点
        		    $dk_money1 = $binfo['bl_money'] * ($substation_info['su_dk_cd']/100); //扣费记录
        		    $fz_money = $substation_info_s['su_fz_money'] + $dk_money1;
        		    $data_user1 = [
        			    'su_fz_money' => $fz_money,
        		    ];
        		    Db("substation")->where("su_id = ".$substation_info['su_s_id'])->update($data_user1);
			    }
			}
			
			//二级分站处理，记录扣点信息
		}
		if($type == "payxunhu"){
		    exit("success");
		}else{
		    exit("验证成功<br />");
		}
	}
	
	public function successok()
	{
	    $id = input("id");
	    $info = Db("wxgroup")->where("wxg_id = ".$id)->find();
	    $times = time();
    	if($times >= session('times')){
    	    session("orderid",null);
    	}
	    $this->assign("info",$info);
		return view();
	}
	
	public function kefu()
	{
	    $id = input("id");
	    $info = Db("wxgroup")->where("wxg_id = ".$id)->find();
	    $this->assign("info",$info);
		return view();
	}	
	
	
	public function share()
	{

	    
	    $nickname = "最美的太阳花、孤海的浪漫、薰衣草、木槿，花、森林小巷少女与狐@、冬日暖阳、午後の夏天、嘴角的美人痣。、朽梦挽歌、心淡然、歇斯底里的狂笑、夏，好温暖、彼岸花开、岸与海的距离、猫味萝莉、软甜阮甜、枯酒无味、寄个拥抱、少女病、江南酒馆、淡尘轻烟、过气软妹、檬℃柠叶、仙九 、且听、风铃、野性_萌、樱桃小丸子、少女の烦躁期、无名小姐、香味少女、清澈的眼眸、海草舞蹈、淡淡de茶香味、雨后彩虹、安全等待你来、薄荷蓝、指尖上的星空、雲朵兒、准风月谈、柠檬、一整个夏天";
	    $nickname_array = explode("、",$nickname);
	    
	    
	    
		$id = input("id");
		$wxgroup = Db("wxgroup")->where("wxg_id = {$id}")->find();
		
		if($wxgroup['wxg_headfile'] == "qq"){
		    $headimg = "1.jpg、2.jpg、3.jpg、4.jpg、5.jpg、6.jpg、7.jpg、8.jpg、9.jpg、10.jpg、11.jpg、12.jpg、13.jpg、14.jpg、15.jpg、16.jpg、17.jpg、18.jpg、19.jpg、20.jpg、21.jpg、22.jpg、23.jpg、24.jpg、25.jpg、26.jpg、27.jpg、28.jpg、29.jpg、30.jpg、31.jpg、32.jpg、33.jpg、34.jpg、35.jpg、36.jpg、37.jpg、38.jpg、39.jpg、40.jpg、41.jpg";
		}else{
		    $headimg = "1.jpeg、2.jpeg、3.jpeg、4.jpeg、5.jpeg、6.jpeg、7.jpeg、8.jpeg、9.jpeg、10.jpeg、11.jpeg、12.jpeg、13.jpeg、14.jpeg、15.jpeg、16.jpeg、17.jpeg、18.jpeg、19.jpeg、20.jpeg、21.jpeg、22.jpeg、23.jpeg、24.jpeg、25.jpeg、26.jpeg、27.jpeg、28.jpeg、29.jpeg、30.jpeg、31.jpeg、32.jpeg、33.jpeg、34.jpeg、35.jpeg、36.jpeg、37.jpeg、38.jpeg、39.jpeg、40.jpeg、41.jpeg";
		}
	    $headimg_array = explode("、",$headimg);
		
	    
	    if(!empty(session("orderid"))){
	        $bill_session = Db("bill")->where("wxg_id = {$id} and bl_sncode = '".session("orderid")."' and bl_status = 2")->find();
	        if(!empty($bill_session)){
	            $back_url =  'http://'.$_SERVER['HTTP_HOST']."/group.php/index/successok/id/".$id."/";
	            Header("Location: ".$back_url);
	            exit;
	        }
	    }
		
		
		//群成员
		$qccontent = array();
		for($i=0;$i<13;$i++){
		    
		    $rand_count_1 = array_rand($nickname_array,1);
		    $rand_count_2 = array_rand($headimg_array,1);
		    $qccontent[$i]['headimg']  = @$headimg_array[$rand_count_2];
		    $qccontent[$i]['nickname'] = @$nickname_array[$rand_count_1];
		}
		

		
		//常见问题
		$kuai_content = explode("\n",$wxgroup['wxg_kuai_content']);
		$kuai_content_count = count($kuai_content);
		$content = array();
		if($wxgroup['wxg_type']==1){
    		for($i=0;$i<$kuai_content_count;$i++){
    		    $tmp_content = explode("----",$kuai_content[$i]);
    		    $content[$i]['title'] = @$tmp_content[0];
    		    $content[$i]['content'] = @$tmp_content[1];
    		}
		}
		//群友评选 
		$qun_content = explode("\n",$wxgroup['wxg_qunyou_content']);
		$qun_content_count = count($qun_content);
		$qcontent = array();
		if($wxgroup['wxg_type']==1){
    		for($i=0;$i<$qun_content_count;$i++){
    		    
    		    $rand_count_1 = array_rand($nickname_array,1);
    		    $rand_count_2 = array_rand($headimg_array,1);
    		    
    		    $tmp_content = explode("----",$qun_content[$i]);
    		    $qcontent[$i]['headimg']  = @$headimg_array[$rand_count_2];
    		    $qcontent[$i]['nickname'] = @$nickname_array[$rand_count_1];
    		    $qcontent[$i]['title']    = @$tmp_content[0];
    		    $qcontent[$i]['count']    = @$tmp_content[1];
    		}
		}
		//更新次数 
		$DATA = [
			'wxg_readcount' => $wxgroup['wxg_readcount']+ 1,
		];
	    Db("wxgroup")->where("wxg_id = {$id}")->update($DATA);
	    //更新次数
		$this->assign('qccontent', $qccontent);
		$this->assign('qcontent', $qcontent);
		$this->assign('content', $content);
		$this->assign('info', $wxgroup);
		$this->assign('id', $id);
		if($wxgroup['wxg_type']==1){
		    return view();
		}else{
		    return view("share_img");
		}
	}
	
	public function turl(){
		
		$id = input("id");
		$wxgroup = Db("wxgroup")->where("wxg_id = {$id}")->find();
		if(empty($wxgroup)){ //群组不存在跳百度
			echo 'function gourl(){window.location.href="https://www.baidu.com/s?ie=UTF-8&wd=群组不存在";}';
			echo "alcspqandxjmiou1()";
			exit;
		}elseif($wxgroup['wxg_status'] == 2){ //群组被禁用
		    echo 'function gourl(){window.location.href="https://www.baidu.com/s?ie=UTF-8&wd=群组被禁用";}';
			echo "alcspqandxjmiou1()";
			exit;
		}
		
		$distribution = Db("distribution")->where("du_id = {$wxgroup['du_id']}")->find();
		if(empty($distribution)){ //分销商不存在
	    	echo 'function gourl(){window.location.href="https://www.baidu.com/s?ie=UTF-8&wd=分销商不存在";}';
			echo "alcspqandxjmiou1()";
			exit;
		}elseif($distribution['du_status'] == 2){
		    echo 'function gourl(){window.location.href="https://www.baidu.com/s?ie=UTF-8&wd=分销商被禁用";}';
			echo "alcspqandxjmiou1()";
			exit;
		}
		
		$substation = Db("substation")->where("su_id = {$wxgroup['su_id']}")->find();
		if(empty($substation)){ //分站不存在
	    	echo 'function gourl(){window.location.href="https://www.baidu.com/s?ie=UTF-8&wd=分站不存在";}';
			echo "alcspqandxjmiou1()";
			exit;
		}elseif($substation['su_status'] == 2){
		    echo 'function gourl(){window.location.href="https://www.baidu.com/s?ie=UTF-8&wd=分站被禁用";}';
			echo "alcspqandxjmiou1()";
			exit;
		}elseif($substation['su_status'] == 3){
		    echo 'function gourl(){window.location.href="https://www.baidu.com/s?ie=UTF-8&wd=分站已到期";}';
			echo "alcspqandxjmiou1()";
			exit;
		}
		
        if($substation['su_dk_cd'] > 0){
            //进行查看是否满足二级分销扣费
            $s_money = 0;
            if($substation['su_s_id']!=0){
                $substation_s = Db("substation")->where("su_id = {$substation['su_s_id']}")->find();
                $s_money = $substation_s['su_dk_cd'];
            }
    		$dk_money = $wxgroup['wxg_money'] * (($substation['su_dk_cd'] + $s_money)/100); //扣费记录
    		if($substation['su_dk'] < $dk_money){
		        echo 'function gourl(){window.location.href="https://www.baidu.com/s?ie=UTF-8&wd=点卡不足，请先充值";}';
			    echo "alcspqandxjmiou1()";
		    	exit;
		    }
		}
			
		
		
		$domain = $_SERVER['HTTP_HOST'];
		$fdoamin = $substation['su_domain'];
		if($domain!=$fdoamin){
		    echo 'function gourl(){window.location.href="https://www.baidu.com/s?ie=UTF-8&wd=不存在的分站域名";}';
			echo "alcspqandxjmiou1()";
			exit;
		}
		
		$substation_paylist = Db("substation_paylist")->where("su_id = {$wxgroup['su_id']} and su_pl_status = 1")->find();
		if(empty($substation_paylist)){ //分销商未开启支付功能
	    	echo 'function gourl(){window.location.href="https://www.baidu.com/s?ie=UTF-8&wd=分销商未开启支付功能";}';
			echo "alcspqandxjmiou1()";
			exit;
		}

		 $time = time();
		 $share = "http://".$substation['su_domain'].url('index/share',array("id"=>$id,"t"=>md5($time),"time"=>$time));
		 $share = base64_encode(urlencode($share));
		 echo 'function gourl(){window.location.href=decodeURIComponent(atob("'.$share.'"));}';
		 echo "alcspqandxjmiou1()";
		 exit;

	}
	
	public function wxb(){
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($useragent, 'MicroMessenger') === false) {
            return false;
        } else {
            return true;
            //echo "微信浏览器允许访问";
        }
    }
	
	
	public function index()
	{
		$id = input("id");
		$wxgroup = Db("wxgroup")->where("wxg_id = {$id}")->find();
		if($wxgroup['wxonoff'] == 2){
		    if($this->wxb()){
		        return view();
		        exit;
		    }
		}
		
        $url = base64_encode(urlencode("https://www.baidu.com/s?wd=%E4%BB%8A%E6%97%A5%E5%A4%B4%E6%9D%A1"));
        $showurl = url('index/turl',array("id"=>$id));
        $showurl = base64_encode(urlencode($showurl));
        echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script></head><body>
<script>document.title=decodeURIComponent(atob(\'JUU1JThBJUEwJUU4JUJEJUJEJUU0JUI4JUFELi4u\'));
function alcspqandxjmiou1(){
	try{
		setTimeout(function(){ gourl(); }, 500);
	}catch(e){
		window.location.href=decodeURIComponent(atob("'.$url.'"));
	}
}
var _hmt = _hmt || [];
(function() { //入口
	var hm = document.createElement("script");
	hm.src = decodeURIComponent(atob("'.$showurl.'"));
	var s = document.getElementsByTagName("script")[0];
	s.parentNode.insertBefore(hm, s);
})();</script></body></html>';
	}


}