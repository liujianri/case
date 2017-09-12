<?php
namespace app\admin\validate;

use think\Validate;

class Articles extends Validate
{
    protected $rule = [
        'title'  =>  'require|unique:article',
        'keywords' => 'require',
    ];
    protected $message  =   [
        'title.require' => '标题不能为空',
        'title.unique' => '标题已存在',
        'keywords.require' => '关键字不能为空',
    ];
     protected $scene = [
        'edit'  =>  ['title'=>'require','keywords'=>'require'],
    ];
}
