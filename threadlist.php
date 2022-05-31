<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Grape+Nuts&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Overpass:ital@1&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Anybody&display=swap" rel="stylesheet">
        <title>FooDiscuss</title>
</head>

<style>
    #catname{font-family: 'Secular One', sans-serif;}
    #catdesc{font-family: 'Grape Nuts', cursive; font-size: 1.5rem;}
    .question{font-family: 'Anybody', cursive;}
    .heading{font-family: 'Overpass', sans-serif;}
</style>

<body>
    <?php include "nav.php"; ?>
    <?php include "connect.php"; ?>

    <!-- category name nd desc -->
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE sno=$id";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
      $catname = $row['category_name'];
      $catdesc = $row['category_desc'];
    }
    ?>

        <?php
            $method = $_SERVER['REQUEST_METHOD'];
            if($method=='POST'){
                $thread_title = $_POST['title'];
                $thread_title = str_replace("<" , "&lt;" , $thread_title);
                $thread_title = str_replace(">" , "&gt;" , $thread_title);
                $thread_desc = $_POST['desc'];
                $thread_desc = str_replace("<" , "&lt;" , $thread_desc);
                $thread_desc = str_replace(">" , "&gt;" , $thread_desc);
                if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])==true){
                    $userid=$_SESSION['id'];
                    $sql = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_user_id`, `thread_cat_id`, `timestamp`) VALUES (NULL, '$thread_title', '$thread_desc', '$userid', '$id', current_timestamp())";
                    $result = mysqli_query($conn,$sql);
                }
            }
        ?>
    
    <!-- thread desc -->
    <div class="container">
        <div class="card my-4">
            <div class="card-body">
                <h2 class="card-title" id="catname"><?php echo $catname;?></h2>
                <p id="catdesc"><?php echo $catdesc;?></p>
            </div>
        </div>
    </div>

    <!-- Ask a question -->
    <div class="container">
    <h3 class="heading">Ask a question to start discussion!</h3>
    <?php
     if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])==true){
      echo   '<form action="'. $_SERVER["REQUEST_URI"].'" method="post" class="question">
                <div class="form-group" >
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" id="desc" >Question Description</label>
                    <input type="text" name="desc" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-success my-4">Submit</button>
            </form>
        ';
     }
     else{
        //  echo '
        //  <div class="alert alert-warning" role="alert">
        // Please login to start discussing!
        // </div>
        //  ';
        echo '<p>Please login to start discussing!</p>';
     }
    ?>
    </div>
    
    <div class="container question">

        <?php
        if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])==true){
            echo '<h3 class="my-3 heading" >Browse Queries!</h3>';}
        ?>
        
        <!-- questions -->

        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn,$sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_id = $row['thread_id'];
        $thread_user_id = $row['thread_user_id'];

        $sql2 = "SELECT * FROM `users` WHERE user_id=$thread_user_id";
        $result2 = mysqli_query($conn,$sql2);
        while($row2 = mysqli_fetch_assoc($result2)){
        $username = $row2['username'];
        if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])==true){
        echo '<div class="accordion " id="accordionFlushExample">
        <div class="accordion-item">
        
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne"><a  href="thread.php?threadid='.$thread_id.'" class="text-dark"><h5 class="accordion-header" id="flush-headingOne">'
              .$title.'</h5></a>- by ' .$username.'
            </button>
          
          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">'.$desc.'</div>
          </div>
        </div>
        </div>';
        }
        if($noResult){
            echo '<div class="alert alert-secondary" role="alert">
            No questions found! Be the first to ask.
            </div>';
        }
        }
    }
        ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>