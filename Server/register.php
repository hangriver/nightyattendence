<?php
/**
 * Created by PhpStorm.
 * User: Leroy
 * Date: 2018/10/5
 * Time: 22:18
 */


//This file is used for give out uid sat in database.

$sid = $_GET['sid'];
$name = $_GET['name'];
$connection = new mysqli("localhost","sign","Pencil1@mysql","sign");
$response = [];
$order2 = "SELECT `NAME` FROM ie_list WHERE SID=".$sid;
$order3 = "SELECT `UID` FROM ie_list WHERE SID=".$sid;
$result0 = $connection->query($order2);
$rs0 = $result0->fetch_row();
$result1 = $connection->query($order3);
$rs1 = $result1->fetch_row();

if ($result0) {
    if ($rs0[0] == $name) {
        $response['status'] = 666;
        $response['uid'] = $rs1[0];
        echo json_encode($response);
    } else {
        $response['status'] = 602;
        echo json_encode($response);
    }
} else {
    $response['status'] = 601;
    echo json_encode($response);
}