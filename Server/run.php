<?php
include "wxBizDataCrypt.php";

$openid = $_GET['openid'];
$connection = new mysqli("localhost","sign","Pencil1@mysql","sign");

$response['status'] = 666;
echo json_encode($response);

//  var_dump($data);
//  echo "<br />";
//  var_dump($data->stepInfoList[0]->step);