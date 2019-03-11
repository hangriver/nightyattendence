<?php
    /** This app is wrote for Chen Yuanli, who wanted to punch my face. */
    function outputList() {
        echo"running/";
        $connection = new mysqli(localhost, sign,"Pencil1@mysql", "sign");
        if($connection){
            echo "connected!/";
        }   else{echo "wrong!/";}
        $readList = "SELECT * FROM `ie_list`";
        $result = $connection->query($readList);
        if($result){
            echo"read/";
        } else{echo"failed/";}
        while($attr = $result->fetch_row()){
            echo "<tr id='".$attr[2]."'>
                <td>{$attr[0]}</td>
                <td>{$attr[2]}</td>
                <td>{$attr[3]}</td>
                <td>{$attr[6]}</td>
                <td><a href='./plus.php?uid=".$attr[1]."'>Plus 1</a></td>
                </tr>";
        }
    }?>

<html>
    <head>
        <title>MANAGE SYSTEM</title>
        <script>
            function search() {
                let name = document.getElementById("aaa").value;
                window.location.href = "./#" + name;
            }
        </script>
    </head>

    <body>
    <p>Please input the name you are looking for:<input type="text" id="aaa"><button value="search" onclick="search()">search</button></p>
    <a href="./clear.php">Clear All</a>
    <p>This is the currently credit status:</p>
    <table width="500px" border="1px">
        <tr>
            <td>Students' Number</td>
            <td>Name</td>
            <td>Credit</td>
            <td>Group Number</td>
            <td>Action</td>
        </tr>
        <?php
        outputList();
        ?>
    </table>
    </body>
</html>
