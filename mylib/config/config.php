<?php
//数据库配置项。
//定义了数据库的链接参数
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "mylib");

//定义了网站的基本参数
define("ROOT_DIR", "http://localhost/mylib/");//定义了根路径
define("STATIC_DIR", ROOT_DIR."static/");//静态文件的url
define("API", ROOT_DIR."api/");//api的url
define("URL_OFFSET", 3);//偏移量，把localhost/mylib/index.php忽略；解析url

error_reporting(E_ALL);//不屏蔽报错信息，方便开发，调试
ini_set('display_errors', 'On');//显示报错信息