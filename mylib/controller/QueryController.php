<?php
/**
 * Created by PhpStorm.
 * User: yifan
 * Date: 16-4-23
 * Time: 下午2:19
 */
class QueryController extends Controller
{

    function all_query()
    {
        $my = new mysql();
        $re = $my->sql("select * from querys");
        $res = array();
        while($row = $re->fetch_assoc())
            $res[] = $row;
        echo json_encode($res);
        return;
    }

    function add_query()
    {
        checkForm(array('sts'));
        $sentence = $_GET['sts'];
        if(!$sentence)
        {
            echo 1;
            return;
        }
        $my = new mysql();
        $re = $my->sql("select count(id) c from querys where sentence='$sentence'");
        if($re->fetch_assoc()['c'] > 0)
        {
            echo "already had";
            return;
        }

        $my->sql("insert into querys(sentence) values('$sentence')");
        if($my->my->error)
            echo "sql error";
        else
            echo 0;
        return;
    }


}
