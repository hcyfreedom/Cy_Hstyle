<?php

class UserController extends Controller
{

    function sign_up()
    {
        checkForm(array('username', 'password', 'gender'));

        $username = $_POST['username'] ?  $_POST['username'] : '';
        $password = $_POST['password'] ?  $_POST['password'] : '';
        $gender = $_POST['gender'] ? $_POST['gender'] : '';
        $my = new mysql();
        $my->sql("insert into users(username, password, gender) values ('$username', '$password', '$gender')");
        if($my->my->error)
            echo "sql error";
        else {
            $_SESSION['uid'] = $my->my->insert_id;
            echo 0;
        }
        return;
    }

    function get_user_info()
    {
        $id = $_SESSION['uid'];
        $my = new mysql();
        $re = $my->sql("select * from users where id=$id");
        header('charset:utf-8');
        $arr = $re->fetch_assoc();
        echo json_encode($arr);
        return;

    }

    function get_user_book_list()
    {
        $id = $_SESSION['uid'];
        $my = new mysql();
        $re = $my->sql("select l.id, b.name, b.type, l.loan_date, l.expire_date end_date, l.remark from loan_records l left join users u on l.user_id=u.id left join books b on b.id=l.book_id where u.id = $id and l.id not in (select loan_id from return_records)");
        $arr = array();
        while($result = $re->fetch_assoc()) {
            if(strtotime($result['end_date']) < time())
                $result['status'] = '超期';
            else
                $result['status'] = '已借';
            $arr[] = $result;
        }
        $re = $my->sql("select l.id, b.name, b.type, l.loan_date, r.return_date end_date, l.remark from loan_records l left join users u on l.user_id=u.id left join books b on b.id=l.book_id left join return_records r on r.loan_id=l.id where u.id = $id and l.id in (select loan_id from return_records)");
        while($result = $re->fetch_assoc()) {
            $result['status'] = '已还';
            $arr[] = $result;
        }
        echo json_encode($arr);
        return;
    }

    function modify_profile()
    {
        checkForm(array('gender', 'password'));
        $id = $_SESSION['uid'];
        $my = new mysql();
        $re = $my->sql("select * from users where id=$id");
        $arr = $re->fetch_assoc();
        $password = $_POST['password'] ? $_POST['password'] : $arr['password'];
        $gender = $_POST['gender'] ? $_POST['gender'] : $arr['gender'];
        $my->sql("update users set password='$password', gender='$gender' where id=$id");
        if($my->my->error)
            echo "sql error";
        echo  $my->my->affected_rows;
        return;
    }


}
