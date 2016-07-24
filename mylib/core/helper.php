<?php
/**
 * Created by PhpStorm.
 * User: yifan
 * Date: 16-4-13
 * Time: 下午10:05
 */
//检查表单，有些控制器的函数会调用这个方法，来检查表单
function checkForm($arr)
{
    foreach($arr as $i)
    {
        if(!((isset($_POST[$i]) || isset($_GET[$i])) ))//表单是否缺失参数
        {
            echo "input mismatch";
            exit;

        }else if(!(@$_POST[$i] || @$_GET[$i])){//表单参数是否为空
            echo "input mismatch";
            exit;
        }
    }
    return true;

}
function now()//时间
{
    return date('Y-m-d H:i:s', time());
}

function next_month()//下个月时间
{
    return date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date("m")+1, date("d"),   date("Y")));
}
