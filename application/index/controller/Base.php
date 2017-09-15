<?php
namespace app\index\controller;
use \think\controller;

class Base extends controller
{
    public function _initialize(){
    	$this->nav();

    }
    public function nav(){
    	$navres= \think\Db::name('cate')->order('id asc')->select();
    	$this->assign('navres',$navres);
    }
}
