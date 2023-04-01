<?php

    session_start();

    if(isset($_SESSION["username"])){
        header("location: list_all_items.php");
        exit;
    }


    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $error = '';

        //make userinput password a hash
        $hashPassword = md5($password);

        $con = mysqli_connect("localhost","root","","login");

        if($con){
            $sqlQuery = "select * from users where username = '".$username."' and password = '".$hashPassword."'";
            $result = mysqli_query($con, $sqlQuery);


            if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)){
                    $_SESSION["username"] = $row["username"];
                    header("location: list_all_items.php");
                    exit;
                }
                
            }
            else{
                $_SESSION["errormsg"] = "Invalid Credentials";
            }
        }
        else{
            echo "<p>DB not Connected</p>";
        }
    }
?>

<html>
    <head>
        <title>Login</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <div class="w-[100%] h-[100%] flex justify-center items-center bg-slate-100" style="background-image: url('https://as2.ftcdn.net/v2/jpg/03/25/01/55/1000_F_325015501_0OREXfdOKXVEkRb3CoULxDDMgGy9gPNW.jpg'); background-repeat: no-repeat; background-size: cover;">
            <div class="w-[80%] flex flex-row justify-center items-center gap-x-[25rem]">
            <!-- <div class="flex justify-center items-center bg-white"> -->
                <div class="w-[450px] bg-blue-200 shadow-lg rounded-md p-4 py-10">
                    <p id="errorUpdate" class="text-red-500 place-self-center text-[1em] text-center mb-2"><?php if(isset($_SESSION["errormsg"])){echo $_SESSION["errormsg"];}?></p>
                    <form action="userLogin.php" method="POST">
                        <input class="w-[100%] outline-none focus:border-blue-400 pl-2 py-4 border-b-2 rounded-md" type="text" name="username" placeholder="Username" required><br>
                        <input class="w-[100%] outline-none focus:border-blue-400 pl-2 py-4 mt-2 border-b-2 rounded-md" type="password" name="password" placeholder="Password" required><br>
                        <button class="w-full py-4  mt-2 rounded-md bg-blue-400 font-bold text-[1.5em] text-white tracking-wide hover:text-black hover:bg-green-500" name="login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>