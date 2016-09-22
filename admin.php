<?php
/*
 * 标题：VR345导航
 * 日期：2015-12-15
 * 作者：vr345
 * 网址：www.vr345.com
 */

//页面压缩输出
ob_start('ob_gzhandler');

//调试模式
define('APP_DEBUG',false);

//定义缓存目录
define( 'RUNTIME_PATH' , './Public/Cache/Admin/' );
//define( 'CONF_PATH' , './Public/Common/' );
define( 'COMMON_PATH' , './Public/Common/' );
define( 'LANG_PATH' , './Public/Common/' );

//项目必须
define('APP_NAME','Admin');
define('APP_PATH','./Admin/');
require 'Public/ThinkPHP/ThinkPHP.php';
?>