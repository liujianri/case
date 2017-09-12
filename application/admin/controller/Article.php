<?php
namespace app\admin\controller;


class Article extends Base
{
    public function lst()
    {	
    	$artres=\think\Db::name('article')->alias('a')->join('cate c','c.id = a.cateid','LEFT')->field('a.id,a.title,a.pic,a.click,a.time,c.catename')->paginate(10);
    	$this->assign('artres',$artres);
    	return $this->fetch();
    }
    public function edit()
    {	
    	if (request()->isPost()) {
    		$data=[
    			'id'=>input('id'),
    			'title'=>input('title'),
    			'keywords'=>input('keywords'),
    			'descs'=>input('descs'),
    			'content'=>input('content'),
    			'cateid'=>input('cateid'),
    		];
    		if ($_FILES['pic']['tmp_name']) {
    			$file = request()->file('pic');
    			$info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
    			if($info){
    				$data['pic']='static/uploads/'.$info->getSaveName();

    			}else{
    				return $this->error($file->getError());
    			}
    		}

			$validate = \think\Loader::validate('Articles');
    		if ($validate->scene('edit')->check($data)) {
    			$db = \think\Db::name('Article')->update($data);
    			if ($db) {
    				return $this->redirect('lst');
    				#return $this->success('添加栏目成功','lst');
    			}else{
    				return $this->error('修改栏目失败');
    			}
    		}else{
    			return $this->error($validate->getError());
    		}
    		return ;
    	}
    	$arts = \think\Db::name('article')->where('id',input('id'))->find();
    	$cateres = db('cate')->select();
    	$this->assign('arts',$arts);
    	$this->assign('cateres',$cateres);
    	return $this->fetch();
    }

    public function del()
    {

    	$id = input('id');
    	if (db('article')->delete($id)) {

    		return $this->redirect('lst');
    	}else{
    		return $this->error('删除失败');
    	}
    }

    public function add()
    {	
    	if (request()->isPost()) {
    		$data=[
    			'title'=>input('title'),
    			'keywords'=>input('keywords'),
    			'descs'=>input('descs'),
    			'content'=>input('content'),
    			'cateid'=>input('cateid'),
    			'time'=>time(),
    		];
    		if ($_FILES['pic']['tmp_name']) {
    			$file = request()->file('pic');
    			$info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
    			if($info){
    				$data['pic']='static/uploads/'.$info->getSaveName();

    			}else{
    				return $this->error($file->getError());
    			}
    		}

			$validate = \think\Loader::validate('Articles');
    		if ($validate->check($data)) {
    			$db = \think\Db::name('Article')->insert($data);
    			if ($db) {
    				return $this->redirect('lst');
    				#return $this->success('添加栏目成功','lst');
    			}else{
    				return $this->error('添加栏目失败');
    			}
    		}else{
    			return $this->error($validate->getError());
    		}
    		return ;
    	}

    	$cateres = db('cate')->select();
    	$this->assign('cateres',$cateres);
    	return $this->fetch();
    }
}