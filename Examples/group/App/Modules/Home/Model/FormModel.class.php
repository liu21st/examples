<?php
class FormModel extends Model {
    public function getList($count=5){
        return $this->order('id DESC')->field(true)->limit($count)->select();
    }

    public function getDetail($id=0){
        return $this->field(true)->find($id);
    }
}