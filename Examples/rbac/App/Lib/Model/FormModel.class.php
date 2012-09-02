<?php
class FormModel extends CommonModel {
    // 自动验证设置
    protected $_validate	 =	 array(
        array('title','require','标题必须！',1),
        array('content','require','内容必须'),
        array('title','','标题已经存在',0,'unique',self::MODEL_INSERT),
        );
    // 自动填充设置
    protected $_auto	 =	 array(
        array('status','1',self::MODEL_INSERT),
        array('create_time','time',self::MODEL_INSERT,'function'),
        );

}