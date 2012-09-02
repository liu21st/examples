<?php
// 系统默认的核心行为扩展列表文件
return array(
    'app_begin'=>array(  //因为项目中也可能用到语言行为,最好放在项目开始的地方
        'CheckLang'      //检测语言
    ),
);