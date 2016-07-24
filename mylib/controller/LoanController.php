<?php
/**
 * Created by PhpStorm.
 * User: yifan
 * Date: 16-4-13
 * Time: 下午10:00
 */
//负责处理借书相关的业务
class loanController extends Controller
{
    public function new_loan()
    {

        checkForm(array('book_id'));

        $user_id = $_SESSION['uid'];
        $book_id = $_POST['book_id'];
        $loan_date = now();
        $expire_date = next_month();
        $remark = isset($_POST['remark']) ? $_POST['remark'] : '';

        $my = new mysql();
        $re = $my->sql("select * from books where id=$book_id and exist='no'");
        if ($re->num_rows > 0) {
            echo "already borrowed";
            return;
        }
        $my->sql("insert into loan_records(user_id, book_id, loan_date, expire_date, remark) values ($user_id, $book_id, '$loan_date', '$expire_date', '$remark')");
        if ($my->my->errno) {
            echo "sql error";
            return;
        }
        $my->sql("update books set exist='no' where id=$book_id");
        if ($my->my->errno) {
            echo "sql error";
            return;
        }
        echo 0;
        return;
    }

    public function return_book()
    {
        checkForm(array('loan_id'));

        $loan_id = $_POST['loan_id'];
        $return_date = now();
        $remark = isset($_POST['remark']) ? $_POST['remark'] : '';
        $my = new mysql();
        $my->sql("insert into return_records(loan_id, return_date, remark) values($loan_id, '$return_date', '$remark')");
        if ($my->my->errno) {
            echo $my->my->error;
            return;
        }
        $my->sql("update books set exist='yes' where id in (select book_id from loan_records where id=$loan_id)");
        if ($my->my->errno) {
            echo $my->my->error;
            return;
        }
        echo 0;
        return;


    }

}