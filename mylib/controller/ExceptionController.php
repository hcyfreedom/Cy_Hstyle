<?php
/**
 * Created by PhpStorm.
 * User: yifan
 * Date: 16-4-14
 * Time: 下午9:40
 */
class ExceptionController extends Controller
{
    public function new_exception()
    {
        checkForm(array('book_id', 'exception'));
        $user_id = $_SESSION['uid'];
        $book_id = $_POST['book_id'];
        $exception = $_POST['exception'];
        $remark = isset($_POST['remark']) ? $_POST['remark'] : '';
        $my = new mysql();
        $my->sql("insert into exceptions(user_id, book_id, exception, remark) values ('$user_id', '$book_id', '$exception', '$remark')");
        if($my->my->error)
        {
            echo 'sql error';
            return;
        }
    }

}