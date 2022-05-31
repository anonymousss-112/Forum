<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>FooDiscuss</title>
</head>

<body>
    <?php include "connect.php"; ?>
    <?php include "nav.php"; ?>

    <div class="container">
        <h1 class="my-3 mx-5">Search Results for <?php echo $_GET["search"]; ?></h1>
        <div class="row row-cols-3 my-5 mx-5">
        <?php
        $query =  $_GET['search'];
        $sql = "SELECT * FROM `threads` where match (thread_title , thread_desc) against ('$query')";
        $result = mysqli_query($conn,$sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            echo '
            <div class="card col my-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><a href="thread.php?threadid='.$thread_id.'" class="text-dark">'.$title.'</a></h5>
                    <p class="card-text">'.$desc.'</p>
                </div>
            </div>
            ';
        }
        if($noResult){
            echo '<p?>No Results.</p>';
        }
    ?>
    </div>
    </div>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>

</html>