<?php
namespace app\index\controller;

class Index extends base
{
    public function Index()
    {	
        return $this->fetch('index');
    }
}
