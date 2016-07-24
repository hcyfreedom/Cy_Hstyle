<?php
include_once("config/config.php");


class mysql
{
    public $my;
    public $sql;
    public $result;
    function __construct($host=DB_HOST, $user=DB_USER, $pass=DB_PASS, $dbname=DB_NAME)//默认使用预定义配置项来链接数据库  主机名 用户名 密码 数据库名称
    {
        $this->my = new mysqli($host, $user, $pass, $dbname);//使用php函数连接数据库
        if ($this->my->connect_error) //处理报错
        {
            return($this->my->connect_errno);
        }
        $this->my->query("set names utf8");//连接的时候指定数据库字符集
        return $this->my;
    }

    //执行sql语句
    function sql($sql)
    {
        $this->sql = $sql;
        $this->result = $this->my->query($this->sql);
        return $this->result;
    }
    

}
?>