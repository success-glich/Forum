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
            $desc=$row['thread_desc'];
            
        }
        ?>

    <div style="background-color:lightgrey;" class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo ucfirst($title); ?> Forums</h1>
            <p class="lead"><?php echo ucfirst($desc);?></p>
            <hr class="my-4">
            <p>This is peer to peer forum share.
                No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.
            </p>
            <p><b>Posted BY: saphal</b></p>
            <br>
            <br>
        </div>
    </div>
    <div class="container" id="ques">
        <h1>Discussion</h1>
        <!-- <?php
            $id=$_GET['catid'];
           $sql="select * from threads where thread_cat_id=$id;";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result)){
            $id= $row['thread_id'];
            $title=$row['thread_title'];
            $desc=$row['thread_desc'];
            
                echo '<div class="media">
                    <img class="mr-3" src="img/user1.jpg" width="54px" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-0" ><a class="text-dark" href="thread.php">'.$title.'</a></h5>
                        '.$desc.'
                    </div>
                    </div>';
        }
       
            ?> -->


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