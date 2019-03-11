<?php
    /**
     * This is designed for wechat login.
     * We are about to start to run on playground.
     *2019/3/10 
     */
    $code = $_GET['code'];
    $url = "https://api.weixin.qq.com/sns/jscode2session?appid=wxb8dbf6bbd4047e36&secret=e518127d718d9be7391e5aad881ba43a&js_code=".$code."&grant_type=authorization_code";
        $res = file_get_contents($url); //获取文件内容或获取网络请求的内容
        $result = json_decode($res);
        if($result->openid){
            $openid = $result->openid;
            $key = $result->session_key;
            $connection = new mysqli("localhost","sign","Pencil1@mysql","sign");
            $order = "INSERT INTO `wechat`(`openID`, `session_key`) VALUES (" . $openid . "," . $key . ")";
            $result = $connection->query($order);
            $response['status'] = 666;
            $response['openid'] = $openid;
            echo json_encode($response);
            }