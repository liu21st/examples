<?php
class IndexAction extends Action{
    public function index($name='ThinkPHP') {
        $this->hello    =   'Hello,'.$name.'！';
        $this->display();
    }
}