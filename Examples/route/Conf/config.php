<?php
return array(
    'URL_MODEL'			=>	2, // 如果你的环境不支持PATHINFO 请设置为3
    'DEFAULT_MODULE'	=>	'Blog',
    //启用路由功能
	'URL_ROUTER_ON'		=>	true,
	//路由定义
	'URL_ROUTE_RULES'	=> 	array(
		'blog/:year\d/:month\d'	=>	'Blog/archive', //规则路由
		'blog/:id\d'			=>	'Blog/read', //规则路由
		'blog/:cate'			=>	'Blog/category', //规则路由
		'/(\d+)/' 				=>	'Blog/view?id=:1',//正则路由
	),
);