<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Welcome to iDiscuss-Coding Forums</title>
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
</head>

<body>

    <?php require_once('partials/_header.php');
        include 'partials/_dbconnect.php';?>
    <?php
            $id=$_GET['thread_id'];
           $sql="select *from threads where thread_id=$id;" ;
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $title=$row['thread_title'];
            $comment=$row['thread_desc'];
            
        }
        ?>
    <?php
        session_start();
        $user_id=$_SESSION['id'];
        $showAlert=false;
            $method=$_SERVER['REQUEST_METHOD'];
            // echo $method;
            if($method=='POST'){
                //insert into comments table
                
                $comment=$_POST['comment'];
                // $th_desc= $_POST['desc'];
                $sql="INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_time`, `comment_by`) VALUES ( '$comment', '$user_id', current_timestamp(), '0'); ";
                $result=mysqli_query($conn,$sql);

                    $showAlert=true;
                    if($showAlert){
                        echo '
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>SUCCESS!</strong> Sucess Your Comment has been addded
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                        ';
                    }

            }

        ?>

    <div style="background-color:lightgrey;" class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo ucfirst($title); ?> Forums</h1>
            <p class="lead"><?php echo ucfirst($comment);?></p>
            <hr class="my-4">
            <p>This is peer to peer forum share.
                No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.
            </p>
            <p>Posted BY: <b>saphal</b></p>
            <br>
            <br>
        </div>
    </div>
   <?php 
  
  if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){

        echo '

        <div class="container">
            <h1>Post a comment</h1>
            <form method="post" action="'. $_SERVER["REQUEST_URI"].'">
                <div class="form-group">
                    <label for="comment">Type your comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                </div>
    
                <button type="comment" class="btn btn-success my-3">Post Comment</button>
            </form>
        </div>
        ' ;
      
   }else{
       echo '
       <div class="container my-4">
           <h1>Posta a Comment</h1>
           <p class="lead mx-5">You are not Logged in.Please login to post a comment</p>
       </div> 
       ';
   }


   ?>
   
    <div class="container" id="ques">
        <?php
            $id=$_GET['thread_id'];
           $sql="select * from comments where thread_id=$id;";
            $result=mysqli_query($conn,$sql);
            $noResult=true;
            while($row=mysqli_fetch_assoc($result)){
                $id= $row['comment_id'];
                $content=$row['comment_content'];
                $comment_time=$row['comment_time'];
                $thread_user_id=$row['thread_id'];
                $sql2="select user_email from users where sno= '$thread_user_id';";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                $name=$row2['user_email'];
                
                echo '<div class="media">
                    <img class="mr-3 " src="img/user1.jpg" width="54px" alt="Generic placeholder image">
                    <div class="media-body">
                        <p class="font-weight-bold mx-0 my-0"><b>'.$name.' at '. $comment_time.'</b></p>
                       
                        '.$content.'
                    </div>
                    </div>';
                    $noResult=false;

            }
            // echo var_dump($noResult);
            if($noResult){
                echo '
                <div style="background-color:lightgrey; min-height:250px;" class="jumbotron jumbotron-fluid">
                <div class="container">
                <p class="display-4"> No Comment Found </p>
                <p class="lead">Be the first person  to write comment</p>
                </div>
                </div>
                ';     
            }
            ?>



    </div>

    <?php require_once('partials/_footer.php');?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>