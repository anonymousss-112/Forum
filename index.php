<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">

    <title>FooDiscuss</title>
  </head>
  <style>
    body{font-family: 'Roboto', sans-serif;}
    #thread{ text-decoration: none;}
    #desc{font-family: 'Roboto Mono', monospace;}
  </style>
  <body>
    <?php include "connect.php"; ?>
    <?php include "nav.php"; ?>
  
    <!-- carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://source.unsplash.com/2400x800/?food,restaurant" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/2400x800/?coffee,foodie" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/2400x800/?food,chocolate" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- categories -->
<div class="container">
  <h2 class="text-center my-4">Browse Categories!</h2>
  <div class="row">
    <?php
    $sql = "SELECT * FROM `categories`";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
      $cat = $row['category_name'];
      $desc = $row['category_desc'];
      $catid = $row['sno'];
      echo '<div class="col-md-3 my-3">
          <div class="card" style="width: 18rem;">
          <img src="https://source.unsplash.com/500x400/?' . $cat . ',food" class="card-img-top" alt="...">
          <div class="card-body">
              <a href="threadlist.php?catid=' .$catid.'" id="thread"><h5 class="card-title">' . $cat . '</h5></a>
              <p class="card-text" id="desc">'.substr($desc , 0 , 95).'...</p>
              <a href="threadlist.php?catid=' .$catid.'" class="btn btn-success">View Thread</a>
          </div>
          </div>
        </div>';
    }
    ?>   
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>