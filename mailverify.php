<html>
    <head>
        <title>verification-mail</title>
    </head>
    
    <?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

    include_once("db.php");
        session_start();
        $code = hash("sha256", $_GET['code']);
        $user = $_GET['user'];

   
         $sql = "SELECT verif_code FROM aj_Users WHERE username = '$user'";
    echo $sql;
        echo isset($conn);
        $result = $conn->query($sql);
      
        $row = $result->fetch_assoc();
      
        
        if($row['verif_code']!= $code){
            echo "wrong code";
        }else{
            echo "success";
            $sql = "UPDATE aj_Users SET is_validate = 1 WHERE username = '$user'";

            $conn->query($sql);
            header("location: index.php?page=connection");

            
        }

    
    ?>
</html>