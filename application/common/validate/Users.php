<?php
namespace app\common\validate;
use think\Validate;

class Users extends Validate
{
    protected $rule =   [
        'username'  => 'require|number|min:6|max:11',
        'password'   => 'require|min:6|max:12',
    ];

    protected $message  =   [
        'username.require' => '账号必须填写',
		'username.number' => '账号必须为数字',
		'username.min' => '账号长度错误 #1',
		'username.max' => '账号长度错误 #2',
        'password.require'   => '用户密码必须填写',
		'password.min' => '密码长度必须6-12位',
		'password.max' => '密码长度必须6-12位',
    ];

    //protected $scene = [
     //   'add'  =>  ['user_id','order_status','order_code','order_price','order_points'],
      //  'edit'  =>  ['user_id','order_status','order_code','order_price','order_points'],
    //];

}