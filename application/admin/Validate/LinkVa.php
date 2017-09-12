<?php
namespace app\admin\validate;

use think\Validate;

class LinkVa extends Validate
{
    protected $rule = [
        'title'  =>  'require|unique:link',
        'url' => 'require',
    ];
    protected $message  =   [
        'title.require' => '链接标题不能为空',
        'title.unique' => '链接标题已存在',
        'url.require' => '链接地址不能为空',
    ];
     protected $scene = [
        'edit'  =>  ['title'=>'require','url'=>'require'],
    ];
}