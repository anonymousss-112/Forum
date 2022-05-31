<?php
    include "connect.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $loginemail = $_POST['loginemail'];
        $loginpass = $_POST['loginpass'];
            $sql = "Select * from users where user_email = '$loginemail'";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            if($num==1){
                $row=mysqli_fetch_assoc($result);
                    if(password_verify($loginpass , $row['password'])){
                        session_start();
                        $_SESSION['loggedin']=true;
                        $_SESSION['id']=$row['user_id'];
                        $_SESSION['useremail']=$loginemail;
                        // echo $row['user_id'];
                    }
                    header("location:index.php");
                
            } 
    }
?>