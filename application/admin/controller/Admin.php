<?php
namespace app\admin\controller;

class Admin extends Base
{
    public function lst()
    {	
    	$adminres = \think\Db::name('admin')->paginate(10);
    	$this->assign('adminres',$adminres);
        return $this->fetch();
    }

    public function add()
    {	
    	if (request()->isPost()) {

    		$data = [
    			'username'=>input('username'),
    			'password'=>input('password')?md5(input('password')):'',
    		];
    		$validate = \think\Loader::validate('AdminVa');
    		if ($validate->check($data)) {
    			$db = \think\Db::name('admin')->insert($data);
    			if ($db) {
    				return $this->redirect('lst');
    				#return $this->success('添加栏目成功','lst');
    			}else{
    				return $this->error('添加栏目失败');
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
        $id = input('id');
    	if (request()->isPost()) {
            $userinfo = \think\Db::name('admin')->find($id);
            $password= $userinfo['password'];
    		$data=[
    			'id'=>input('id'),
    			'username'=>input('username'),
                'password'=>input('password')?md5(input('password')):$password,
    		];
    		$validate = \think\Loader::validate('AdminVa');
    		if ($validate->scene('edit')->check($data)) {
    			if ($db = \think\Db::name('admin')->update($data)) {
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
    	$admins = db('admin')->find($id);
    	$this->assign('admins',$admins);
    	return $this->fetch();
    }

    public function del()
    {

    	$id = input('id');
        if ($id ==1) {
            return $this->error('不可以删除主管理员','lst');
        }
    	if (db('admin')->delete($id)) {
    		return $this->success('删除成功','lst');
    	}else{
    		return $this->error('删除失败');
    	}
    }

}
