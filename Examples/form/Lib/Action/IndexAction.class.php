<?php
class IndexAction extends Action {

    // 处理表单数据
    public function insert() {
        $Form = D("Form");
        if ($Form->create()) {
            if (false !== $Form->add()) {
                $this->success('数据添加成功！');
            } else {
                $this->error('数据写入错误');
            }
        } else {
            // 字段验证错误
            $this->error($Form->getError());
        }
    }

}