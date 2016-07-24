<?php
/**
 * Created by PhpStorm.
 * User: yifan
 * Date: 16-4-13
 * Time: 下午9:47
 */
//书
class BookController extends Controller
{
    public function new_book()
    {
        checkForm(array('name', 'type', 'remark', 'author'));

        $name = $_POST['name'] ? $_POST['name'] : '';
        $type = $_POST['type'] ? $_POST['type'] : '不详';
        $author = $_POST['author'] ? $_POST['author']: '不详';
        $remark = $_POST['remark'] ? $_POST['remark'] : '';
        $my = new mysql();
        $my->sql("insert into books (name, type, remark, exist, author) values('$name', '$type', '$remark', 'yes', '$author')");
        if($my->my->error)
        {
            echo $my->my->error;
            return;
        }
        echo 0;
        return;
    }

    public function search_book()
    {
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $my = new mysql();
        $re = $my->sql("select * from books where name like '%$keyword%' and exist='yes'");
        $arr = array();
        while($result = $re->fetch_assoc())
            $arr[] = $result;
        echo json_encode($arr);
        return;
    }

    public function natural_search()
    {
        $searchby = isset($_GET['searchby']) ? $_GET['searchby'] : 'name'; //根据什么查询（默认是 书名）
        $sentence = isset($_GET['sts']) ? trim($_GET['sts']) : '';//用户搜索的句子
        $my = new mysql();
        $re = $my->sql("select * from querys");//从语句库里调出全部语句
        while($row = $re->fetch_assoc())//以关联数组的形式从数据库查询结果中取出一条记录
        {
            $con = str_replace('%', '(.*)', $row['sentence']);//把%替换成.*,.*可以匹配正则表达式里的任意长度字符串。query里的%被换成.*，就可以和搜索框里的字符匹配
            $arr = array();
            if(preg_match("/$con/", $sentence, $arr))
            {
                $keyword = $arr[1];//优先匹配query库里的第一句
                $re = $my->sql("select * from books where $searchby like '%$keyword%' and exist='yes'");//从数据库中查询
                $arr = array();
                while($result = $re->fetch_assoc())//把查询结果存在数组中
                    $arr[] = $result;
                echo json_encode($arr);
                return;
            }
        }
        echo 'no such record';
        return;
    }

    public function all_book()
    {
        $my = new mysql();
        $re = $my->sql("select * from books");
        $arr = array();
        while($result = $re->fetch_assoc())
            $arr[] = $result;
        echo json_encode($arr);
        return;
    }

    public function delete_book()
    {
        checkForm(array('book_id'));
        $id = $_POST['book_id'];
        $my = new mysql();
        $my->sql("delete from books where id=$id and exist='yes'");
        if($my->my->affected_rows > 0)
        {
            echo 0;
            return;
        }
        else{
            return "fail";
        }
    }

    //修改书
    public function modify_book()
    {
        checkForm(array('book_id'));
        $book_id = $_POST['book_id'];

        $my = new mysql();
        $re = $my->sql("select * from books where id=$book_id");
        $arr = $re->fetch_assoc();
        $name = $_POST['name'] ? $_POST['name'] : $arr['name'];
        $type = $_POST['type'] ? $_POST['type'] : $arr['type'];
        $author = $_POST['author'] ? $_POST['author'] : $arr['author'];
        $my->sql("update books set name='$name', type='$type', author='$author' where id=$book_id");
        if ($my->my->error)
            echo "sql error";
        echo $my->my->affected_rows;
        return;
    }

}