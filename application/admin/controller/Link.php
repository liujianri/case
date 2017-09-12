<?php
namespace app\admin\controller;

use app\admin\model\Link as Links ;
class Link extends Base
{
    public function lst()
    {	
    	$linkres = \think\Db::name('link')->paginate(10);
    	$this->assign('linkres',$linkres);

        return $this->fetch();
    }

    public function add()
    {	
    	if (request()->isPost()) {

            $datas = [
                    'title'=>input('title'),
                    'url'=>input('url'),
                    'descs'=>input('descs'),
                ];
    		$validate = \think\Loader::validate('LinkVa');
    		if ($validate->check($datas)) 
            {
                $lin = new Links;
                $lin->data($datas);
    			if ($lin->save()) {
    				return $this->redirect('lst');
    				#return $this->success('添加栏目成功','lst');
    			}else{
    				return $this->error('添加链接失败');
    			}
    		}else{
    			return $this->error($validate->getError());
    		}
    		return;
    	}
        return $this->fetch();
    }

    public function edit()
    {	

    	if (request()->isPost()) {
            $data=input('post.');
    		$validate = \think\Loader::validate('LinkVa');
    		if ($validate->scene('edit')->check($data)) {
    			if ($db = \think\Db::name('link')->update($data)) {
    				return $this->redirect('lst');
    			}else{
    				return $this->error('修改失败');
    			}
    		}else{
    			return $this->error($validate->getError());
    		}
    		return ;
    	}
    	$id = input('id');
    	$links = db('link')->where('id',$id)->find();
    	$this->assign('links',$links);
    	return $this->fetch();
    }

    public function del()
    {
    	$id = input('id');
    	if (db('link')->delete($id)) {

    		return $this->success('删除成功','lst');
    	}else{
    		return $this->error('删除失败');
    	}
    }

}
