<?php
namespace app\index\controller;
use \think\controller;

class Search extends controller
{
    public function index()
    {	
        return $this->fetch('search');
    }
  
}
