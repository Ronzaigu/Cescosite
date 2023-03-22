<?php
session_start();

if (isset($_SESSION['userPK'])){
    $user_pk = $_SESSION['userPK'];
    $modos_pk = array("157", "150", "181");

    if(in_array($user_pk, $modos_pk)){
        include_once("db.php");
        $a_pk = $_GET["a_pk"];
        $sql = "DELETE FROM aj_articles WHERE ARTICLES_PK = $a_pk";
        mysqli_query($conn, $sql);
        echo "<script>window.close();</script>";
    }else{
        echo "STOP HACKING PLEASE.";
    }

}else{
    echo "STOP HACKING PLEASE.";
}



?>