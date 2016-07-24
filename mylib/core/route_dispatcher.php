<?php
//分发路由的类
class RouteDispatcher
{
    public $route_table;

    public function __construct($url_table){
        $this->route_table = $url_table;
    }

    public function dispatch($request_url, $request_method)
    {
        $matched = false;
        foreach($this->route_table as $url_and_method => $execute)
        {
            $split_array = explode(':', $url_and_method);
            $method = $split_array[0];
            $url = $split_array[1];
            if(preg_match('=^'.$url.'$=', $request_url) && $method == $request_method)
            {
                if(is_callable($execute))
                {
                    $execute();
                    return;
                }
                $controller_and_function = explode('@', $execute);
                $controller = $controller_and_function[0];
                $function = $controller_and_function[1];
                if($controller == 'view')
                {
                    include("view/$function");
                    return;
                }
                $controller = new $controller;
                $controller->$function();
                return;
            }
        }
        if(!$matched)
        {
            echo "Route matching fail";
            return;
        }
    }
}