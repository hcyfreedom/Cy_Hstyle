<?php
/**
 * Created by PhpStorm.
 * User: yifan
 * Date: 16-4-15
 * Time: 下午8:52
 */
//管理员操作
class AdminController
{
    public function get_all_user_info()
    {
        $my = new mysql();
        $re = $my->sql("select u.id, u.username, u.password, u.gender, u.exception from users u");
        if($my->my->error)
            echo $my->my->error;
        $res = array();
        while($row = $re->fetch_assoc())
        {
            $id = $row['id'];
            $books = array();
            $book = $my->sql("select name from loan_records l left join books b on b.id=l.book_id where user_id=$id");
            while($b = $book->fetch_assoc()){
                $books[] = $b['name'];
            }
            $row['books'] = $books ? implode(', ', $books) : '';
            $res[] = $row;
        }
        echo json_encode($res);
    }

    public function add_admin()
    {
        checkForm(array('admin_name', 'admin_pass'));
        if($_SESSION['mid'] != 1) {
            echo '权限不足';
            return;
        }
        $username = $_POST['admin_name'];
        $password = $_POST['admin_pass'];
        $my = new mysql();
        $my->sql("insert into managers(username, password) values('$username','$password' )");
        if($my->my->error)
            echo $my->my->error;
        echo $my->my->affected_rows;
        return;
    }

    public function delete_admin()
    {
        checkForm(array('admin_id'));
        if($_POST['admin_id'] == 1)
        {
            echo '无法删除自己';
            return;
        }
        if($_SESSION['mid'] != 1)
        {
            echo '权限不足';
            return;
        }
        $id = $_POST['admin_id'];
        $my = new mysql();
        $my->sql("delete from managers where id = $id");
        if($my->my->error)
            echo $my->my->error;
        echo $my->my->affected_rows;
        return;
    }

    public function get_all_admin()
    {
        $my = new mysql();
        $re = $my->sql("select id, username admin_name from managers");
        $arr = array();
        while($row = $re->fetch_assoc())
        {
            $arr[] = $row;
        }
        echo json_encode($arr);

    }

    public function modify_profile()
    {
        checkForm(['user_id', 'user_name', 'user_sex','user_pass', 'record']);
        $password = $_POST['user_pass'];
        $gender = $_POST['user_sex'];
        $name = $_POST['user_name'];
        $id = $_POST['user_id'];

        $my = new mysql();
        $re = $my->sql("select * from users where id=$id");
        $exception = $re->fetch_assoc()['exception'];
        if($_POST['record'] == '无')
            $exception = '无';
        else if($exception == '无')
            $exception = $_POST['record'];
        else
            $exception .=','.$_POST['record'];
        $my->sql("update users set password='$password', gender='$gender', username='$name', exception='$exception' where id=$id");
        if($my->my->error)
            echo "sql error";
        echo  $my->my->affected_rows;
        return;
    }
}