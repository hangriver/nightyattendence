<?php

    /** This app is wrote for Chen Yuanli, who wanted to punch my face. */

    function outputList() {
        $page = 0;
        $minline = 0;
        $maxline = 0;

        /** if ($_GET['page']){
         **   $minline = $page * 50;
         **   $maxline = 50 + ($page * 50);
         **} 
        */

        echo"running/";

        $connection = new mysqli(localhost, sign,"Pencil1@mysql", "sign");

        if($connection){

            echo "connected!/";

        }   else{echo "wrong!/";}

        $readList = "SELECT * FROM `run_log` ORDER BY `run_log`.`date` DESC";

        $result = $connection->query($readList);

        if($result){

            echo"read/";

        } else{echo"failed/";}

        while($attr = $result->fetch_row()){

            echo "<tr>

                <td>{$attr[0]}</td>

                <td>{$attr[1]}</td>

                <td>{$attr[2]}</td>

                <td>{$attr[3]}</td>";

            if($attr[4] == 1){
                $status = "Completed";
            } else {
                $status = "Failed";
            }
            echo "<td>$status</td>
                </tr>";

        }

    }?>

<html>
    <head>
        <title>MANAGE SYSTEM</title>
    </head>
    <body>
    <p>Here is the log of running</p>
    <table width="500px" border="1px">

        <tr>

            <td>UID</td>

            <td>NAME</td>

            <td>STEP</td>

            <td>TIME</td>

            <td>STATUS</td>

        </tr>
    <?php
        outputList();
    ?>
    </body>
</html>