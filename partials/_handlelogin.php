<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $email=$_POST['loginEmail'];
    $pass=$_POST['loginPassword'];

    $sql="select *from users where user_email='$email';";
    $result=mysqli_query($conn,$sql);
    $numRows=mysqli_num_rows($result);
    if($numRows==1){
        $row=mysqli_fetch_assoc($result);
        print_r($row);
        if(password_verify($pass,$row['user_pass'])){ #password Verify by convert given password into hash function
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['id']=$row['sno'];
                $_SESSION['useremail']=$email;
                
        }
        header("location:/forum/index.php");
       
    }else {
        $showError=true;
        header("location:/forum/index.php");
    }

}



?>