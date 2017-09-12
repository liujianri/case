<?php
namespace app\admin\controller;


class Index extends Base
{
    public function Index()
    {	
        return $this->fetch('index');
    }

    public function tests()
    {
    	$id = input('id');
    	if ($db=db('cate')->find($id)) {

    		return json_encode($db);
    	}else{
    		return $this->error('失败');
    	}

    }
}
