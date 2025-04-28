<?php
namespace app\common\validate;
use think\Validate;

class Rule extends Validate
{
    protected $rule =   [
        'title'  => 'require',
        'name'   => 'require',
    ];

    protected $message  =   [
        'title.require' => '权限名称不能为空!',
		'name.require' => '路径不能为空!',
    ];

    //protected $scene = [
     //   'add'  =>  ['user_id','order_status','order_code','order_price','order_points'],
      //  'edit'  =>  ['user_id','order_status','order_code','order_price','order_points'],
    //];

}