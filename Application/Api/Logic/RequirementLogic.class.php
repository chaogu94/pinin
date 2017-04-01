<?php
/*
 * 业务逻辑类
 * 在这个页面上处理跟用户有关的业务逻辑
 * */
namespace Api\Logic;

use Think\Model;
use Think\Page;

class RequirementLogic extends Model
{

    public $pagesize = 10;
    /*查询所有用户发布的需求，可以通过关键字查找，传入页码参数，默认排序方式为距离和时间*/
    public function all($kw)
    {
        $Data = M("requirement");
        $condition['content'] = array("like","%$kw%");//模糊查询出所有的需求
        $totalCount = $Data->where($condition)->count();//查找出来总数
        $pageCount = ceil($totalCount/$this->pagesize);//总页数
        $page = new Page($totalCount,$this->pagesize);//创建页对象，参数为总页数和每页大小
        $list = $Data->where($condition)->limit($page->firstRow,$page->listRows)->select();

        $Form = M("pics");
        foreach($list as $k=>$v){
            $itemId = $v['id'];
            $pics = $Form->field("src")->where("rid=$itemId")->select();
            $list[$k]["pics"] = $pics;
        }
        return array('totalCount'=>$totalCount,'pageCount'=>$pageCount,'list'=>$list);
    }

    /*通过id查找我发布的商品*/
    public function myAll($uid,$kw)
    {
        $Data = M("requirement");
        $condition['content'] = array("like","%$kw%");//模糊查询出所有的需求
        $condition['uid'] = $uid;
        $totalCount = $Data->where($condition)->count();//查找出来总数
        $pageCount = ceil($totalCount/$this->pagesize);//总页数
        $page = new Page($totalCount,$this->pagesize);//创建页对象，参数为总页数和每页大小
        $list = $Data->where($condition)->limit($page->firstRow,$page->listRows)->select();
        return array('totalCount'=>$totalCount,'pageCount'=>$pageCount,'list'=>$list);
    }

    /*删除我发布的需求，提示用户删除后不能找回数据*/
    public function del($rid)
    {
        $Data = M("requirement");
        return $Data->delete($rid);
    }

}