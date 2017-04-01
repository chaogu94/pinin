<?php
namespace Api\Controller;
use Think\Controller;
class TestController extends BController {
    public function test(){
        $data = M("user");
        $result = $data->select();
        $this->assign('result',$result);
        $res_json = json_encode($result);
        echo $res_json;
        $this->display();
    }
}