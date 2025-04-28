<?php
namespace app\common\validate;
use think\Validate;

class Navigat extends Validate
{
    protected $rule =   [
        'ns_title'      => 'require|min:2|max:36',
		'ns_controller' => 'require',
		'ns_method'     => 'require',
    ];

    protected $message  =   [
        'ns_title.require' => '导航名称必须填写',
		'ns_title.min' => '导航名称长度错误 #1',
		'ns_title.max' => '导航名称长度错误 #2',
		'ns_controller.require' => '控制器不能为空',
		'ns_method.require' => '方法不能为空',
    ];

}