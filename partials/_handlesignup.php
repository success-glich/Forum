<?php
echo 'don aayo don';
    $showAlert='false';
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include '_dbconnect.php';
        $user_email=$_POST['signupEmail'];
        $pass=$_POST['signuppassword'];
        $cpass=$_POST['signupcpassword'];
        //check whether this email exists 

        $existSql="Select * from users where user_email='$user_email'";
        $result=mysqli_query($conn,$existSql);
        echo '$result';
        $numRow=mysqli_num_rows($result);
        if($numRows>0){
            $showError="Email is already in use";
        }else{
            if($pass==$cpass){
                $hash=password_hash($pass,PASSWORD_DEFAULT);
                $sql="insert into users (user_email,user_pass) values('$user_email','$hash');";
                $result=mysqli_query($conn,$sql);
                if($result){
                    $showAlert=true;
                    header("location:/forum/index.php?signupsuccess=true");
                    exit();
                }
                
                
            }else{
                
                $showError="Password do not match";
            }
        }
        header("location:/forum/index.php?signupsuccess=false&error=$showError");

    }

?>