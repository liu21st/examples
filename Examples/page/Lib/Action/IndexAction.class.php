<?php

class IndexAction extends Action {

    public function index() {
        import("@.ORG.Page");       //导入分页类
        $Form   =   M('Form');
        $count  = $Form->count();    //计算总数
        $Page = new Page($count, 5);
        $list   = $Form->limit($Page->firstRow. ',' . $Page->listRows)->order('id desc')->select();
        // 模拟设置分页额外传入的参数
        $Page->parameter    =   'search=key&name=thinkphp';
        // 设置分页显示
        $Page->setConfig('header', '条数据');
        $Page->setConfig('first', '<<');
        $Page->setConfig('last', '>>');
        $page = $Page->show();
        $this->assign("page", $page);
        $this->assign("list", $list);
        $this->display();
    }

}