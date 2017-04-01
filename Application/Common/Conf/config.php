<?php
return array(
	//'配置项'=>'配置值'
    'URL_CASE_INSENSITIVE'=>true,//不区分大小写
    'URL_MODEL'=>1,
    'DB_TYPE'=>'mysql',// 数据库类型
    'DB_HOST'=>'127.0.0.1',// 服务器地址
    'DB_NAME'=>'pin',// 数据库名
    'DB_USER'=>'root',// 用户名
    'DB_PWD'=>'root',// 密码
    'DB_PORT'=>3306,// 端口
    //'DB_PREFIX'=>'tp_',// 数据库表前缀
    'DB_CHARSET'=>'utf8',// 数据库字符集
    //TP框架获取数据库时将字段名转换成小写，所以不支持识别驼峰命名的字段，需要在配置文件里添加配置项
    'DB_PARAMS'=>array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL)
);