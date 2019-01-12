<?php
/**
 * Created by PhpStorm.
 * User: Leroy
 * Date: 2018/9/30
 * Time: 16:30
 */

//This php file is used for LBS sign in.

$uid = $_GET['uid'];
$status = $_GET['status'];
$response = [];//make responses
$date = date();
$connection = new mysqli("localhost","sign","Pencil1@mysql","sign"); //start a new module
$order0 = "UPDATE ie_list SET CREDIT=CREDIT+1 WHERE UID=".$uid;//increase credit
//$order1 = "UPDATE `ie_list` SET last_login=".$date." WHERE UID=".$uid;//set last sign in time
//$order2 = "INSERT INTO `ie_log`(`uid`, `time`) VALUES (".$uid.",".$date.")";//set log

if ($status == 666) {
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