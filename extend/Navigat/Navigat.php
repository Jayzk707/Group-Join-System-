<?php
// +----------------------------------------------------------------------
// |     Sun soft  
// |    用户导航类
// +----------------------------------------------------------------------
use think\Db;
use think\Config;
use think\Session;
use think\Request;
use think\Loader; 


/*
-- ----------------------------
-- think_navigat_show，导航总表，
-- ns_id:主键，sns_id:上级主键，ns_title:导航名称，ns_icon:导航图标，ns_sort:导航排序，ns_status:导航状态 1正常，为0禁用
-- ----------------------------



-- ----------------------------
-- think_group_navigat，用户导航表，
-- ns_id:导航ID，group_id:用户群组ID
-- ----------------------------



*/


class Navigat
{
	//默认配置
    protected $config = [
        'group' => "auth_group_access", // 用户关连群组
		'group_nav' => "navigat_group", //用户群组关连列表 
		'navigat_show' => "navigat_show", //导航信息表
    ];
	
	
	/*
	显示导航
	传入用户ID值
	*/
	public function show_navigat($uid){
		$map = [
			'uid' => $uid,
        ];
		$info = Db::name($this->config['group'])->where($map)->field('group_id')->select(); //查出用户所有群组信息
		
		$group_ids    = [];
        foreach ($info as $g) {
            $group_ids = array_merge($group_ids, explode(',', trim($g['group_id'], ',')));
        }
        $group_ids = array_unique($group_ids);
		
		$maps = [
			'group_id' => ['in', $group_ids],
		];
		$info = Db::name($this->config['group_nav'])->where($maps)->field('ns_id')->select(); //查出所属群组所关连的导航信息
		
		$nav_ids    = [];
        foreach ($info as $g) {
            $nav_ids = array_merge($nav_ids, explode(',', trim($g['ns_id'], ',')));
        }
        $nav_ids = array_unique($nav_ids);
		
		$nav_maps = [
			'ns_id' => ['in', $nav_ids],
			'ns_status' => 1,
			'sns_id' => 0,
		];
		
		$nav_info = Db::name($this->config['navigat_show'])->where($nav_maps)->order("ns_status desc,ns_sort asc")->select(); //查出一级导航信息
		
		foreach ($nav_info as $k=>$v) { //查询下级目录内容
			$nav_info[$k]['data'] = array();
			$nav_info[$k]['number'] = 0;
			$nav_maps_2 = [
				'ns_status' => 1,
				'sns_id' => $v['ns_id'],
			];
			$nav_info_2 = Db::name($this->config['navigat_show'])->where($nav_maps_2)->order("ns_status desc,ns_sort asc")->select(); //查出二级导航信息
			if(!empty($nav_info_2)){
				$nav_info[$k]['number'] = 1;
				$nav_info[$k]['data'] = $nav_info_2;
			}
        }
		return $nav_info;
	}
	
	
	
}

?>