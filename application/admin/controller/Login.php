<?php
namespace app\admin\controller;
use \think\controller;
use app\admin\model\Login as Log;
class Login extends controller
{
    public function index()
    {	

        if (request()->isPost()) {
            $login= new Log;
            $status = $login->login(input('username'),input('password'));
            if ($status==1) {
                return $this->redirect('Index/index');
            }elseif ($status==2) {
                return $this->error('帐号或密码错误');
            }else{
                return $this->error('登录不存在');
            }
        }
        return $this->fetch('login');
    }

    public function logout(){

        session(null);
        return $this->success('退出成功','index');
    }
}
