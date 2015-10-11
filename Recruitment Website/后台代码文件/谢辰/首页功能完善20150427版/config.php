<?php
/*
 *Author: 谢辰
 *function: 进行工程配置
 *AlterTime: 2015/04/05
 */
return array(
	//'配置项'=>'配置值'
	'AUTOLOAD_NAMESPACE'    => array(
        'Lib'               => APP_PATH . 'Home/Lib/',
    ),
    //数据库连接参数
    'DB_TYPE' => 'mysql',
    'DB_HOST' => '127.0.0.1',
    'DB_USER' => 'root',
    'DB_PWD' => '',
    'DB_NAME' => 'test_db',
    // 配置邮件发送服务器
    'MAIL_HOST' =>'smtp.163.com',//smtp服务器的名称
    'MAIL_SMTPAUTH' => TRUE, //启用smtp认证
    'MAIL_USERNAME' =>'ericjcd@163.com',//你的邮箱名
    'MAIL_FROM' =>'ericjcd@163.com',//发件人地址
    'MAIL_FROMNAME'=>'十三行公司',//发件人姓名
    'MAIL_PASSWORD' =>'WAITFORyy10',//邮箱密码
    'MAIL_CHARSET' =>'utf-8',//设置邮件编码
    'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件
    //引导前端html引用css的路径：
    //'TMPL_PARSE_STRING' => array(
    	//'__HOMECSS__' => __ROOT__.'/'.APP_NAME.'/Home/View/WebShow/css&js',//引用CSS路径
    	//'__HOMEIMG__' => __ROOT__.'/'.APP_NAME.'/Home/View/WebShow/home',//引用HOME的Image路径
    	//),
    //设置SESSION有效时间
    'SESSION_EXPIRE' => '3600',//有效时间为3600s
    //设置COOKIE
    'COOKIE_EXPIRE' => '86400',//有效时间为1天
    'USER_AUTH_KEY' =>'authId', // 用户认证SESSION标记
);