<?php
/**
 * Created by PhpStorm.
 * User: Leroy
 * Date: 2/28/2019
 * Time: 11:36 PM
 */

$connection = new mysqli(localhost, sign,"Pencil1@mysql","sign");
$plus = "update `ie_list` set CREDIT = CREDIT+1 where uid=" . $_GET['uid'];
$result = $connection->query($plus);
echo"
        Succeeded! Jumping back.<br />
        <script>
            window.location.href = './index.php';
        </script>
";