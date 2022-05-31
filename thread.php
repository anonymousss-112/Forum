<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <title>FooDiscuss</title>
    
</head>
<style>
    .comment{font-family: 'Prompt', sans-serif;}
</style>
<body>
    <?php include "nav.php"; ?>
    <?php include "connect.php"; ?>


    <!-- category name nd desc -->
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
      $thread_title = $row['thread_title'];
      $thread_desc = $row['thread_desc'];
    }
    ?>

    <!-- comment by html form -->
    <?php
        $method = $_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            $comment = $_POST['comment'];
            $comment = str_replace("<" , "&lt;" , $comment);
            $comment = str_replace(">" , "&gt;" , $comment);
            if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])==true){
                $userid=$_SESSION['id'];
                $sql = "INSERT INTO `comments` (`comment_id`, `comment_desc`, `comment_by`, `thread_id`, `comment_time`) VALUES (NULL, '$comment', '$userid', '$id', current_timestamp());";
                $result = mysqli_query($conn,$sql);
            }
        }
    ?>

    <!-- question -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $thread_title ?></h1>
            <p class="lead"><?php echo $thread_desc ?></p>
            <hr class="my-2">
        </div>
    </div>

    <!-- comment form -->
    <div class="container my-5 comment">
        <h3>Post a comment</h3>
        <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
            <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" name="comment" rows="3"></textarea>
                <?php
                // if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])==true){
                    
                    // echo '<input type="hidden" name="user_id" value="'.$user_id.'">';
                    // echo $_SESSION['id'];
                // }
                ?>
            </div>
            <button type="submit" class="btn btn-success my-3">Submit</button>
        </form>
    </div>

    <!-- comment section -->
    <div class="container comment">
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn,$sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $desc = $row['comment_desc'];
        $thread_id = $row['thread_id'];
        $comment_time = $row['comment_time'];
        $comment_by = $row['comment_by'];

        $sql2 = "SELECT * FROM `users` WHERE user_id=$comment_by";
        $result2 = mysqli_query($conn,$sql2);
        while($row2 = mysqli_fetch_assoc($result2)){
        $username = $row2['username'];

            echo '<div class="my-4">
            <div class="media my-4">
            <div class="media-body">
                        <em><p><b>By '.$username.' at ' .$comment_time.'</b></p></em>
                        <h6 class="mt-0 my-0"> '.$desc.'</h6>
                    </div>
                </div>
            </div>';
        }
        }
        if($noResult){
            echo '<div class="alert alert-secondary" role="alert">
            No discussions found! Be the first to comment.
          </div>';
        }
        ?>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>