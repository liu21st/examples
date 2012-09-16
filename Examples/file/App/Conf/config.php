<?php
return array(
    'URL_MODEL'         =>  1, // 如果你的环境不支持PATHINFO 请设置为3
    'DB_TYPE'           =>  'mysql',
    'DB_HOST'           =>  'localhost',
    'DB_NAME'           =>  'examples',
    'DB_USER'           =>  'root',
    'DB_PWD'            =>  '',
    'DB_PORT'           =>  '3306',
    'DB_PREFIX'         =>  'think_',
    'TMPL_PARSE_STRING' =>  array( // 添加输出替换
        '__UPLOAD__'    =>  __ROOT__.'/Uploads',
    ),
);