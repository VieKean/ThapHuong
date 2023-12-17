<?php
    $server = 'localhost';
    $user = 'root';
    $pass ='';
    $database = 'thaphuong';

    $conn = new mysqLi($server, $user, $pass, $database);

    if($conn){
        mysqLi_query($conn, "SET NAMES 'utf8' ");
    }
    else{
        echo "ko thành công";
    }
?>