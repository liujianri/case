<?php
namespace app\index\controller;


class Article extends Base
{
    public function index()
    {	
    	$id=input('artid');
    	db('article')->where('id', $id)->setInc('click');
    	$arts=\think\Db::name('article')->alias('a')->join('cate c','c.id = a.cateid','LEFT')->field('a.cateid,a.id,a.title,a.content,a.time,a.descs,a.click,a.keywords,c.catename')->find($id);

    	$prev=\think\Db::name('article')->where('id','<',$id)->where('cateid','=',$arts['cateid'])->order('id desc')->limit(1)->value('id');
    	$next=\think\Db::name('article')->where('id','>',$id)->where('cateid','=',$arts['cateid'])->order('id asc')->limit(1)->value('id');

    	$ralateres=$this->ralate($arts['keywords']);
    	$this->assign('ralateres',$ralateres);
    	$this->assign('arts',$arts);
    	$this->assign('prev',$prev);
    	$this->assign('next',$next);
        return $this->fetch('article');
    }



    public function ralate($keywords){
    	$arr= explode(',', $keywords);
    	static $ralateres=array();

    	foreach ($arr as $k => $v) {
    		$artres= \think\Db::name('article')->order('id desc')->where('keywords','like','%'.$v.'%')->limit(10)->field('id,title,time')->select();

    		
			$ralateres=array_merge($ralateres,$artres);

    	}
    	
    	return arr_unique($ralateres);
    }
}
