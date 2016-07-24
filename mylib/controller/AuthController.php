<?php
/**
 * Created by PhpStorm.
 * User: yifan
 * Date: 16-4-13
 * Time: 下午7:18
 */
//登陆的验证
class AuthController extends Controller
{

    function login()
    {
        checkForm(array('username', 'password'));

        $username = $_POST['username'] ? $_POST['username'] : '';
        $password = $_POST['password'] ? $_POST['password'] : '';
        $my = new mysql();
        $re = $my->sql("select id,username from users where username='$username' and password='$password'");
        if($re->num_rows > 0)
        {
            $row = $re->fetch_assoc();
            $_SESSION['uid'] = $row['id'];
            $_SESSION['name'] = $row['username'];
            $_SESSION['pay'] = 'false';
            echo 0;
            return;
        }
        echo "no such user";
        return;
    }

    function admin_login()
    {
        checkForm(array('username', 'password'));

        $username = $_POST['username'] ? $_POST['username'] : '';
        $password = $_POST['password'] ? $_POST['password'] : '';
        $my = new mysql();
        $re = $my->sql("select id, username from managers where username='$username' and password='$password'");
        if($re->num_rows > 0)
        {
            $row = $re->fetch_assoc();
            $_SESSION['mid'] = $row['id'];
            $_SESSION['name'] = $row['username'];
            echo 0;
            return;
        }
        echo "no such manager";
        return;
    }
}
