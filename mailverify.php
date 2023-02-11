<html>
    <head>
        <title>verification-mail</title>
    </head>
    
    <?php
    error_reporting(E_ALL);

    include_once("db.php");
        session_start();
        $code = hash("sha256", $_GET['code']);
        $password = $_SESSION['mail_password'];
        $username = $_SESSION['mail_username'];
        $mail = $_SESSION['mail_mail'];

        if($code != $_SESSION["mail_code"]){
            echo "Invalid code";

        }else{
            $sql = "INSERT INTO ju_Users (username, passwd, mail) VALUES ('$username', '$password', '$mail')";
                                
                            
            if (mysqli_query($conn, $sql)) {
                $sqlU = "SELECT ju_Users_PK FROM ju_Users WHERE username = '".$username."'";
                $result = $conn->query($sqlU);
                $row = $result->fetch_assoc();

                $userPK = $row["ju_Users_PK"];


                $_SESSION["user"] = $username;
                $_SESSION["userPK"] = $userPK;
                
                
            

                header('Location: cescosite.php');
            
                
            }else{
                echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    ?>
</html>