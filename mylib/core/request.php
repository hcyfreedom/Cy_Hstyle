<?php
/**
 * Created by PhpStorm.
 * User:yifan
 * Date: 16-4-13
 * Time: 下午9:22
 */
session_start();
$url = explode('index.php', $_SERVER['PHP_SELF'])[1];
if(substr($url, 0, 1) == '/')
    $url = substr($url, 1);

$url = $url ? $url : '/';
$method = $_SERVER['REQUEST_METHOD'];

$check_login = array(
    'GET:user',
    'GET:api/user',
    'GET:api/user/booklist',
    'GET:api/booklist',
    'POST:api/loan',
    'POST:api/return',
    'POST:api/user/profile',
);

$check_admin = array(
    'GET:admin',
    'POST:api/book',
    'POST:api/book',
    'POST:api/modify/book',
    'POST:api/delete/book',
    'GET:api/userlist',
    'GET:api/admin',
);

foreach($check_login as $check)
{
    if($check == $method.':'.$url && !isset($_SESSION['uid']))
    {
        $root = ROOT_DIR;
        echo "<script>alert('not log in');window.location.href='$root./login';</script>";
        return;
    }
}

foreach($check_admin as $check)
{
    if($check == $method.':'.$url && !isset($_SESSION['mid']))
    {
        $root = ROOT_DIR;
        echo "<script>alert('not admin');window.location.href='$root./admin/login';</script>";
        return;
    }
}
