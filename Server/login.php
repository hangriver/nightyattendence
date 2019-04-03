<?php
    /**
     * This is designed for wechat login.
     * We are about to start to run on playground.
     *2019/3/10 
     */
    include "wxBizDataCrypt.php";

    $code = $_GET['code'];
    $iv = $_GET['iv'];
    $encryptedData = $_GET['encrypteddata'];
    $appid = "wxb8dbf6bbd4047e36";
    $uid = $_GET['uid'];
    $connection = new mysqli("localhost","sign","Pencil1@mysql","sign");
    $order0 = "SELECT `NAME` FROM `ie_list` WHERE UID=". $uid;
    $result0 = $connection->query($order0);
    $name = $result0->fetch_row();
    $date = date("Y-m-d H:i:s");
    $enough = 0;

    $url = "https://api.weixin.qq.com/sns/jscode2session?appid=wxb8dbf6bbd4047e36&secret=e518127d718d9be7391e5aad881ba43a&js_code=".$code."&grant_type=authorization_code";
        $res = file_get_contents($url); //获取文件内容或获取网络请求的内容
        $result = json_decode($res);
        if($result->openid){
            $openid = $result->openid;
            $sessionKey = $result->session_key;
            //echo $key;
            //echo $openid;
            $pc = new WXBizDataCrypt($appid, $sessionKey);
            $errCode = $pc->decryptData($encryptedData, $iv, $data );
            if ($errCode == 0) {
                //echo "decrypted";
                $stepobj = json_decode($data);
                $i = count($stepobj->stepInfoList);
                $step = $stepobj->stepInfoList[$i-1]->step;
                if ($step >= 10000){
                    $enough = 1;
                }
                //insert log into database
                $order1 = "INSERT INTO `run_log` (`uid`, `name`, `step`, `date`, `status`) VALUES ('" . $uid . "', '". $name[0] ."', '". $step ."', '". $date ."', '". $enough ."')";
                $result1 = $connection->query($order1);
                if($result){
                    $response['status'] = 666;
                } else {$response['status'] = 602;}
            } else {
                //print($errCode . "\n");
                $response['status'] = $errCode;
            }

            $response['step'] = $step;
            $response['order'] = $order1;
            $response['name'] = $name[0];
            $response['en'] = $enough;
            $response['openid'] = $openid;
            echo json_encode($response);
            }