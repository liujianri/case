<?php
namespace app\admin\validate;

use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'catename'  =>  'require|unique:cate',
    ];
    protected $message  =   [
        'catename.require' => '栏目名称不能为空',
        'catename.unique' => '栏目名称已存在',
    ];
    protected $scene = [
        'edit'  =>  ['catename'=>'require'],
    ];
}