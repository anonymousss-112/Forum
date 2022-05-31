<?php
   
include "connect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$_POST['email'];
    $password=$_POST['pass'];
    $cpass=$_POST['cpass'];
    $username=$_POST['username'];
    $username = str_replace("<" , "&lt;" , $username);
    $username = str_replace(">" , "&gt;" , $username);
    
    if($password!="" && $cpass!="" && $email!="" && $username!=""){
        $hash = password_hash($password , PASSWORD_DEFAULT);

        $existSql = "Select * from users where user_email = '$email'";
        $result2 = mysqli_query($conn,$existSql);
        $num = mysqli_num_rows($result2);
        if($num>0){
            $error="Email already exists!";
            header("Location: index.php?signupsuccess=false&error=$error");
        }
        else{
            if($password==$cpass){
                $sql = "INSERT INTO `users` (`user_id`, `user_email`, `username` , `password`, `signup_time`) VALUES (NULL, '$email', '$username' , '$hash', current_timestamp());";
                $result = mysqli_query($conn,$sql);
                if($result){
                    $success=true;
                    $error="No error";
                    header("Location: index.php?signupsuccess=true&error=$error");
                }
            }
            else{
                $error="Passwords not matching!";
                header("Location: index.php?signupsuccess=false&error=$error");
            }
        }
    }
    else{
        $error="Please insert data properly!";
        header("Location: index.php?signupsuccess=false&error=$error");
    }
}


?>