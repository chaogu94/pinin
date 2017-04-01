<?php
/*
 * 业务逻辑类
 * 在这个页面上处理跟用户有关的业务逻辑
 * */
namespace Api\Logic;

use Think\Model;

class UserLogic extends Model
{

    //用户注册
    public function reg($username,$password,$tel){
        $data = M("user");
        $where['username'] = $username;
        $num = $data->where($where)->count();
        if($num>0){
            //用户名已经存在
            return '用户名已经存在';
        }else{
            //用户名不存在
            $condition['tel'] = $tel;
            $num = $data->where($condition)->count();
            if($num>0){
                //手机号已注册
                return "手机号已注册";
            }
        }
        //手机号和用户名都不存在，可以进行注册
//        $Form = D("user");
        if($data->create()){
            $num = $data->add();
            return $num;
        }
        return "注册失败";
        /*$con['username'] = $username;
        $con['tel'] = $tel;
        $con['password'] = $password;
        $result = $data->data($con)->add();
        if($result>0){
            return $result;
        }else{
            return "插入失败";
        }*/
    }

    //用户登录
    public function login($account,$password){
        $Data = M("user");
        $where['username|tel']=$account;
        $where['password']=$password;
        $result = $Data->field("username,head,location,account")->where($where)->find();
        return $result;
    }

    public function test($username,$password,$tel){
        $M = new Model();
        $sql = "call register('$username','$password','$tel')";
        $res = $M->add($sql);

        return $res;
    }
}