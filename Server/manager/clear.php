<?php
/**
 * Created by PhpStorm.
 * User: Leroy
 * Date: 2/28/2019
 * Time: 11:43 PM
 */

$connection = new mysqli(localhost, sign,"Pencil1@mysql","sign");
$clear = "update `ie_list` set CREDIT = 0 where 1";
$result = $connection->query($clear);
echo"
        Succeeded! Jumping back.<br />
        <script>
            window.location.href = './index.php';
        </script>
";