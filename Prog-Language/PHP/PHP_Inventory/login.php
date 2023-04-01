<?php

    session_start();

    if(isset($_SESSION["username"])){
        header("location: list_all.php");
        exit;
    }

    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        echo "</p>'".md5($password)."'</p>";
        $connection = mysqli_connect("localhost","root","","login");

        if($connection){
            $result = mysqli_query($connection, "select * from users where username = '".$username."' and password = '".md5($password)."'");

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $_SESSION["username"] = $row["username"];
                    header("location: list_all.php");
                    exit;
                }
            }
        }
        else{
            echo "<p>Error!</p>";
        }
    }

?>


<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        
    <div>
         <form action="login.php" method="POST">
            <p>Username<p><input  name="username"  required>
            <p>Password</p><input  name="password"  required></br></br>
            <button name="login">Login</button>
        </form>
    </div>

    </body>
</html>