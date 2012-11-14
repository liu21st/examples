<?php
class IndexAction extends Action {
    public function index(){
        $this->assign('title','ThinkPHP示例：模板继承');
        $this->assign('var','这里是子模板定义内容!');
        $this->display();
    }

}