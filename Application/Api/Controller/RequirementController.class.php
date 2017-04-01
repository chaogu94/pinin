<?php
namespace Api\Controller;

use Api\Logic\RequirementLogic;
use Think\Controller;

class RequirementController extends BController
{
    public $mainLogin;

    function _initialize()
    {
        $this->mainLogin = new RequirementLogic();
    }

    /*发布需求*/
    public function publish()
    {
        if ($_POST) {
            $Data = D("requirement");
            if ($Data->create()) {
                $num = $Data->add();
                if ($num > 0)
                    $result = wrap_json(parent::CODE_OK, '发布成功');
            } else {
                $result = wrap_json(parent::CODE_FAILD, $Data->getError());
            }
            echo my_json_encoding($result);
        }
    }

    /*查询所有用户发布的需求，可以通过关键字查找，传入页码参数，默认排序方式为距离和时间*/
    public function all()
    {
        $res = $this->mainLogin->all(I("kw"));
//        $result = wrap_json(parent::CODE_OK,"查找成功",$res);
        echo my_json_encoding($res);
    }

    /*通过id查找我发布的商品*/
    public function myAll()
    {
        $res = $this->mainLogin->myAll(I('uid'), I("kw"));
//        $result = wrap_json(parent::CODE_OK,"查找成功",$res);
        echo my_json_encoding($res);
    }

    /*删除我发布的需求，提示用户删除后不能找回数据*/
    public function del()
    {
        if ($this->mainLogin->del(I("rid")) > 0) {
            $result = wrap_json(parent::CODE_OK, "删除成功");
        } else {
            $result = wrap_json(parent::CODE_FAILD, "删除失败");
        }
        echo my_json_encoding($result);
    }

    /*修改我发布的*/
    public function update()
    {
        if ($_POST) {
            $Data = D("requirement");
            if($Data->create()){
                $num = $Data->save();
                if($num>0){
                    $result = wrap_json(parent::CODE_OK,"修改成功");
                }else{
                    $result = wrap_json(parent::CODE_FAILD,"修改失败");
                }
            }
            echo my_json_encoding($result);
        }
    }
}