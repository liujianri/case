<?php
namespace app\index\controller;
use \think\controller;

class Article extends controller
{
    public function index()
    {	
        return $this->fetch('article');
    }
}
