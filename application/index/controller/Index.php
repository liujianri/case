<?php
namespace app\index\controller;
use \think\controller;

class Index extends controller
{
    public function Index()
    {	
        return $this->fetch('index');
    }
}
