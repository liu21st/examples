<?php

class IndexAction extends Action {

    // 首页
    public function index() {
        $Form = M("Form");
        // 按照id排序显示前5条记录
        $list = $Form->order('id desc')->limit(3)->select();
        $this->list =   $list;
        $this->display();
    }

    // 检查标题是否可用
    public function checkTitle($title='') {
        if (!empty($title)) {
            $Form = M("Form");
            if ($Form->getByTitle($title)) {
                $this->error('标题已经存在');
            } else {
                $this->success('标题可以使用!');
            }
        } else {
            $this->error('标题必须');
        }
    }

    // 处理表单数据
    public function insert() {
        $Form = D("Form");
        if ($vo = $Form->create()) {
            if (false !== $Form->add()) {
                $vo['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
                $vo['content'] = nl2br($vo['content']);
                $this->ajaxReturn($vo, '表单数据保存成功！', 1);
            } else {
                $this->error('数据写入错误！');
            }
        } else {
            $this->error($Form->getError());
        }
    }
}