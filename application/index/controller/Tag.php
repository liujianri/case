<?php
namespace app\index\controller;


class Tag extends Base
{
    public function index()
    {	

    	$tags=input('tags');
    	
    	$artres= \think\Db::name('article')->alias('a')->join('cate c','c.id = a.cateid','LEFT')->field('a.cateid,a.id,a.title,a.pic,a.time,a.descs,a.click,a.keywords,c.catename')->order('a.id desc')->where('a.keywords','like','%'.$tags.'%')->paginate(10);
    
    	$this->assign('artres',$artres);
    	return $this->fetch('lst');
    }
}