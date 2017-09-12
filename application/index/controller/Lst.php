<?php
namespace app\index\controller;
use \think\controller;

class Lst extends controller
{
    public function index()
    {	
        return $this->fetch('lst');
    }
}