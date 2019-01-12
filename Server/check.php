<?php
/**
 * Created by PhpStorm.
 * User: Leroy
 * Date: 2018/9/30
 * Time: 16:30
 */

$rec = $_GET['timekey'];
$uid = $_GET['uid'];
$connection = new mysqli("localhost","sign","Pencil1@mysql","sign"); //start a new module
$response = [];//make responses
$date = date();
$order0 = "UPDATE ie_list SET CREDIT=CREDIT+1 WHERE UID=".$uid;//increase credit
//$order1 = "UPDATE `ie_list` SET last_login=".$date." WHERE UID=".$uid;//set last sign in time
//$order2 = "INSERT INTO `ie_log`(`uid`, `time`) VALUES (".$uid.",".$date.")";//set log
$time = date("YmdHi");
$skey = md5($time);

if ($rec == $skey) {
    $result = $connection->query($order0);
    //$writedate = $connection->query($order1);
    //$setlog = $connection->query($order2);
} else {
    $response['status'] = 602; //602 is for wrong time key
    $response['uid'] = $uid;
    $response['timekey'] = $rec;
    echo json_encode($response);
    die();
}

if ($result) {
    $response['status'] = 666; //666 is for ok
    $response['uid'] = $uid;
    $response['timekey'] = $rec;
    echo json_encode($response);
} else {
    $response['status'] = 601; //601 is sql error code
    $response['uid'] = $uid;
    $response['timekey'] = $rec;
    echo json_encode($response);
}