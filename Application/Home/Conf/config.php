<?php
return array(
	'admin_user' => 'root',
	'admin_pass' =>  'root',
	'VIEW_PATH' =>  './html/', //指定模板目录
	'URL_PARAMS_BIND'  =>  true, //开启url参数绑定功能
	'URL_HTML_SUFFIX'=>'bit|html|fuck',  //开启伪静态
	'URL_CASE_INSENSITIVE' =>true,//url大小写不敏感
	'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'bit_nvshen',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_FIELDS_CACHE'=>false,// 关闭字段缓存
    'URL_MODEL' =>2,
);