<?php
/*
 * maqiang
 * */
//将信息转换成自定义的json类型格式
function wrap_json($code, $message, $data = array())
{
    return array("code" => $code, "message" => $message, "data" => $data);
}

//将数据转换成json字符串
function my_json_encoding($array, $option = true)
{
    if ($option)
        return json_encode($array, JSON_UNESCAPED_UNICODE);//JSON_UNESCAPED_UNICODE表示不进行加密编码，可以显示出汉字
    else
        return json_encode($array);
}