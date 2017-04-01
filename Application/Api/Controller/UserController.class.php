<?php
namespace Api\Controller;

use Think\Controller;
use Api\Logic;

class UserController extends BController
{
    public $mainLogin;
    /* function _initialize(){
         $this->mainLogin = new UserLogic();
     }*/
    /*用户登录，返回用户信息*/
    public function login()
    {
        if (IS_POST) {
            $userlogic = new Logic\UserLogic();
            $data = $userlogic->login(I('account'), I('password'));
            if ($data) {
                $result = wrap_json(parent::CODE_OK, "登录成功", $data);
            } else {
                $result = wrap_json(parent::CODE_FAILD, "用户名或密码错误");
            }
        }
        echo my_json_encoding($result);
    }

    /*用户注册*/
    public function reg()
    {
        if (IS_POST) {
            $userlogic = new Logic\UserLogic();
            $message = $userlogic->reg(I("username"), I("password"), I("tel"));
            if (is_numeric($message)) {
                $result = wrap_json(parent::CODE_OK, "注册成功");
            } else {
                $result = wrap_json(parent::CODE_FAILD, $message);
            }
            echo my_json_encoding($result);
        }
    }

    /*用户注销*/
    public function logout()
    {
    }
    /*修改用户信息*/
    public function update()
    {
        if ($_POST) {
            $Data = D("user");
            if($Data->create()){
                $num = $Data->save();
                if($num>0){
                    $result = wrap_json(parent::CODE_OK,"修改成功");
                }else{
                    $result = wrap_json(parent::CODE_FAILD,"没有要修改的信息");
                }
            }
            echo my_json_encoding($result);
        }
    }


    //
    public function test()
    {
        if (IS_POST) {
            $userlogic = new Logic\UserLogic();
            $data = $userlogic->test(I('username'), I('password'), I("tel"));
            if ($data) {
                $result = wrap_json(parent::CODE_OK, "test登录成功", $data);
            } else {
                $result = wrap_json(parent::CODE_FAILD, "登录失败");
            }
        }
        echo my_json_encoding($result);
    }
}