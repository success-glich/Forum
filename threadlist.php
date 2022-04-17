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
            $id=$_GET['catid'];
           $sql="select *from categories where category_id=$id" ;
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
                $catname=$row['category_name'];
                $catdesc=$row['category_description'];
                
            }
        ?>
        <?php
        $showAlert=false;
            $method=$_SERVER['REQUEST_METHOD'];
            // echo $method;
            if($method=='POST'){
                //insert into db in threads table
                $th_title=$_POST['title'];
                $th_desc= $_POST['desc'];
                $sql=" insert into threads(thread_title,thread_desc,thread_cat_id,thread_user_id) values('$th_title','$th_desc','$id','0');";
                $result=mysqli_query($conn,$sql);

                    $showAlert=true;
                    if($showAlert){
                        echo '
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>SUCCESS!</strong> Your tread has been added! Please wait for community to respond
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                        ';
                    }

            }

        ?>

    <div style="background-color:lightgrey;" class="container my-4">
        <div class="jumbotron">
            <p class="display-4">Welcome to <?php echo ucfirst($catname); ?> Forums</p>
            <p class="lead"><?php echo ucfirst($catdesc);?></p>
            <hr class="my-4">
            <p>This is peer to peer forum share.
                No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.
            </p>
            <a href="" class="btn btn-success btn-lg" href="#" role="button">Learn More</a>
        </div>
    </div>
    <?php 
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

 
            echo '<div class="container">
                <h1>Ask A Question</h1>  
                <form method="post" action="'. $_SERVER["REQUEST_URI"].'">
                    <div class="form-group">
                        <label for="title">Problem title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                            placeholder="Enter title">
                        <small id="titleHelp" class="form-text text-muted">Keep your title as short and crisp as
                            possible.</small>
                    </div>
                    <div class="form-group">
                        <label for="desc">Ellaborate Your concern</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success my-3">Submit</button>
                </form>
            </div>';
        }

        else{
            echo '
            <div class="container">
            <h1>Ask A Question</h1>  
            <p class="lead">You are not logged in. Please login to be able to start a Disccusion</p>
        </div>
            ';

        }

    ?>
   
    <div class="container" id="ques">

        <?php
            $id=$_GET['catid'];
           $sql="select * from threads where thread_cat_id=$id;";
            $result=mysqli_query($conn,$sql);
            $noResult=true;
            while($row=mysqli_fetch_assoc($result)){
                $id= $row['thread_id'];
                $title=$row['thread_title'];
                $desc=$row['thread_desc'];
                $thread_time=$row['timestamp'];
                $thread_user_id=$row['t_user_id'];
                $sql2="select user_email from users where sno= '$thread_user_id';";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                $name=$row2['user_email'];
                
                echo '<div class="media">
                    <img class="mr-3" src="img/user1.jpg" width="54px" alt="Generic placeholder image">
                    <div class="media-body">
                    <h5 class="mt-0" ><a class="text-dark" href="thread.php?thread_id='.$id.'">'.$title.'</a></h5>
                    '.$desc.'
                    </div>
                    </div>
                    <p class="font-weight-bold mx-0 my-0"><b>' .$row2['user_email'].'at '. $thread_time.'</b></p>
                    ';
                    $noResult=false;

            }
            echo var_dump($noResult);
            if($noResult){
                echo '
                <div style="background-color:lightgrey; min-height:250px;" class="jumbotron jumbotron-fluid">
                <div class="container">
                <p class="display-4"> No Threads Found </p>
                <p class="lead">Be the first person to ask a question</p>
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