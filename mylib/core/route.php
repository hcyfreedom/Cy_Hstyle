<?php
//加载文件
include_once("config/config.php");
include_once("core/request.php");//预处理请求
include_once("controller/Controller.php");//加载控制器
include_once("core/route_dispatcher.php");//路由分发·加载，按照路由表来转发请求

//parse url and method from request解析url和方法


//路由表
$dpt = new RouteDispatcher(
    array(

        //返回视图，GET 请求路径 跳转到相应界面
        'GET:/' => 'view@index.html',
        'GET:login' => 'view@user_login.html',
        'GET:admin' => 'view@admin_index.html',
        'GET:admin/login' => 'view@admin_load.html',
        'GET:user' => 'view@user_index.html',
        'GET:books' => 'view@all_book.html',
        'GET:query' => 'view@query.html',



        //login and sign up
        'POST:api/user' => 'UserController@sign_up',
        'POST:api/auth' => 'AuthController@login',
        //manager login
        'POST:api/admin/auth' => 'AuthController@admin_login',

        //get user info
        'GET:api/user' => 'UserController@get_user_info',
        //get user book list
        'GET:api/user/booklist' => 'UserController@get_user_book_list',
        //modify user info
        'POST:api/user/profile' => 'UserController@modify_profile',

        //create book
        'POST:api/book' => 'BookController@new_book',
        //modify book
        'POST:api/modify/book' => 'BookController@modify_book',
        //delete book
        'POST:api/delete/book' => 'BookController@delete_book',
        //get all users info
        'GET:api/userlist' => 'AdminController@get_all_user_info',
        //get all admin name
        'GET:api/admin' => 'AdminController@get_all_admin',

        //search book
        'GET:api/booklist' => 'BookController@search_book',
        //search all book
        'GET:api/booklist/all' => 'BookController@all_book',

        'GET:api/allquery' => 'QueryController@all_query',
        'GET:api/addquery' => 'QueryController@add_query',
        'GET:api/natural' => 'BookController@natural_search',

        //new loan
        'POST:api/loan' => 'LoanController@new_loan',
        //new return
        'POST:api/return' => 'LoanController@return_book',

        //new exception
        'POST:api/exception' => 'Exception@new_exception',
        'POST:api/modify' => 'AdminController@modify_profile',
        'POST:api/admin' => 'AdminController@add_admin',
        'POST:api/delete/admin' => 'AdminController@delete_admin',

        //全部付款，会话
        'GET:api/pay' => function(){
            $_SESSION['pay'] = 'true';
            echo 0;
        },

//        'GET:info' => function(){
//            phpinfo();
//        },
//
//        'GET:redis' => function(){
//            $redis = new Redis();
//            $redis->connect('localhost');
//            echo $redis->get('this');
//        }

    )
);

//分发路由，执行
$dpt->dispatch($url, $method);



