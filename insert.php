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

    <?php
       $method = $_SERVER['REQUEST_METHOD'];
       if($method=='POST'){
           $recipie_name=$_POST['recipieName'];
           $name=$_POST['Name'];
           $recipie=$_POST['recipie'];

           $sql= "INSERT INTO `recipies` (`sno`, `recipie_name`, `Name`, `recipie_desc`, `created`) VALUES (NULL, '$recipie_name', '$name', '$recipie', current_timestamp())";
           $result = mysqli_query($conn,$sql);
       }
    ?>

    <div class="container">
    <form action="insert.php" method="post" class="my-3">
  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Recipie Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="recipieName" name="recipieName">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Your Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Name" name="Name">
    </div>
  </div>
  <div class="input-group">
  <label for="inputPassword3" class="col-sm-2 col-form-label">Recipie</label>
    <div class="col-sm-10">
    <textarea class="form-control" aria-label="With textarea" name="recipie" cols="10" rows="15"></textarea>
    </div>
  
</div>
  <button type="submit" id="addBtn" class="btn btn-primary my-3">Add Recipie</button>
</form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>