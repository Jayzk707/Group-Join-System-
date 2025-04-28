<?php
namespace app\common\validate;
use think\Validate;

class Group extends Validate
{
    protected $rule =   [
        'title'  => 'require|min:6|max:36',
    ];

    protected $message  =   [
        'title.require' => '群组名称不能为空!',
		'title.min' => '群组名称不能小于6个字符大于36个字符! #1',
		'title.max' => '群组名称不能小于6个字符大于36个字符! #2',
    ];

    //protected $scene = [
     //   'add'  =>  ['user_id','order_status','order_code','order_price','order_points'],
      //  'edit'  =>  ['user_id','order_status','order_code','order_price','order_points'],
    //];

}