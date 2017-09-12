<?php
namespace app\admin\validate;

use think\Validate;

class AdminVa extends Validate
{
    protected $rule = [
        'username'  =>  'require|max:25|unique:admin',
        'password' => 'require',
    ];
    protected $message  =   [
        'username.require' => '用户名不能为空',
        'username.unique' => '用户名已存在',
        'username.max' => '用户名不能大于25位',
        'password.require' => '密码不能为空',
    ];
    
    protected $scene = [
        'edit'  =>  ['username'=>'require'],
    ];
}