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
                $response['status'] = 666;
            } else {
                //print($errCode . "\n");
                $response['status'] = $errCode;
            }

            $response['step'] = $step;
            
            $response['openid'] = $openid;
            echo json_encode($response);
            }