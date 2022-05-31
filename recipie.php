<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>FooDiscuss</title>
</head>
<style>
  #btn{margin: 5px 565px;}
  #btn:hover{background-color: rgb(86, 83, 83);}
  #add{ text-decoration: none; color: white;}
</style>

<body>
    <?php include "connect.php"; ?>
    <?php include "nav.php"; ?>

    
    <?php
        $id=$_GET['recid'];
        $sql = "SELECT * FROM `recipies` WHERE sno=$id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $cat = $row['recipie_name'];
            $name = $row['Name'];
            $desc = $row['recipie_desc'];
        }
    ?>

<!-- insert comment -->
    <?php
        $method = $_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            $comment = $_POST['recipie'];
            $comment = str_replace("<" , "&lt;" , $comment);
            $comment = str_replace(">" , "&gt;" , $comment);
            if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])==true){
                $userid=$_SESSION['id'];
                $sql = "INSERT INTO `reccomments` (`comment_id`, `comment_desc`, `comment_by`, `rec_id`, `time`) VALUES (NULL, '$comment', '$userid', '$id', current_timestamp());";
                $result = mysqli_query($conn,$sql);
            }
        }
    ?>

    
<!-- recipie -->
    <div class="container">
        <div class="jumbotron my-3">
        <h1 class="display-4"><?php echo $cat?></h1>
        <p class="lead">Posted by- <b><?php echo $name?></b></p>
        <hr class="my-4">
        <p><?php echo $desc?></p>
        <h5>Thanks!</h5>
        </div>
    </div>

    <!-- Add and read comments -->
    <div class="container my-4">
        <?php
        if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])==true){
        echo '<form action="'. $_SERVER['REQUEST_URI'].'" method="post" class="my-3">
        <div class="input-group">
        <textarea class="form-control" aria-label="With textarea" name="recipie" cols="10" rows="5"></textarea>
        </div>
        <button type="submit" id="addBtn" class="btn btn-primary my-3">  Add comment  </button>
        </form>
        <p class="my-3"><u><i>Read Comments</u></i></p>';
        
        

        $id = $_GET['recid'];
        $sql = "SELECT * FROM `reccomments` WHERE rec_id=$id";
        $result = mysqli_query($conn,$sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $desc = $row['comment_desc'];
        $rec_id = $row['rec_id'];
        $comment_time = $row['time'];
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
    }
    else{
        echo '<h6><i>Please login to add or read comments!</i></h6>';
    }
        ?>
    </div>


    

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>