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

    <div class="container">
        <h1 class="my-3 text-center">Browse our Specials!</h1>
        <button type="button" id="btn" class="btn btn-dark"><a href="insert.php" id="add">Add new Recipie</a></button>
    </div>

    <div class="container my-3">
        <div class="row">

    <?php
      $sql = "SELECT * FROM `recipies`";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($result)){
      $cat = $row['recipie_name'];
      $name = $row['Name'];
      $desc = $row['recipie_desc'];
      $recid = $row['sno'];

        echo  '<div class="col">
          <div class="card" style="width: 18rem;">
            <img src="img.jpg" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">'.$cat.'</h5>
              <p class="card-text">'.substr($desc , 0 , 60).'</p>
              <a href="recipie.php?recid='.$recid.'" class="btn btn-success">Read More</a>
            </div>
          </div>
          </div>';
    }
    ?>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>