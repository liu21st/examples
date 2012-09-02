<?php
class IndexAction extends Action {
    // 首页
    public function index() {
        trace('本调试信息仅页面Trace中可见');
        // 往流程Tab项添加trace信息
        trace('页面Trace代码','执行流程','INFO');
        $Form = M("Form");
        // 随便进行几个查询，显示页面的SQL查询记录
        $list   =   $Form->field('id,title')->order('id desc')->limit(0,5)->select();
        trace(count($list),'返回结果');
        $vo = $Form->find();
        trace($vo,'查询数据'); // 调试当前数据
        echo $vo['test']; // 这里存在一个未定义索引
        $Form->order('id desc')->limit(3)->select();
        // 输出一些调试信息 用于显示
        $string = $name.'ThinkPHP'; // 这里存在一个变量未定义错误
        trace($string,'框架名称');
        trace(THINK_VERSION,'框架版本');
        // 抛出一些错误
        trace('这是定制的错误提示信息','错误信息','NOTIC');

        $this->display();
    }
}