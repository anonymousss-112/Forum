<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;1,300&display=swap" rel="stylesheet">

    <title>FooDiscuss</title>
</head>
<style>
    #heading{font-family: 'Merriweather', serif;}
</style>

<body>
    <?php require "nav.php"; ?>
    <?php require "connect.php"; ?>

    <?php 
        $method = $_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $query = $_POST['query'];
            $address = $_POST['address'];
            $name = $_POST['name'];
            $sql = "INSERT INTO `contact` (`sno`, `email`, `name`, `address`, `phone`, `query`) VALUES (NULL, '$email', '$name', '$address', '$contact', '$query');";
            $result = mysqli_query($conn,$sql);
            if($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Your query or suggestion is recorded, we will contact you soon!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please insert data properly.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        }
    ?>

    <div class="container my-4 form">
    <h1 class="my-3" id="heading">Feel free to contact us for any query!</h1>
        <form class="row g-3 my-3" action="contact.php" method="post">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="email">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputPassword4" name="name">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="inputAddress" name="address">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Contact No.</label>
                <input type="text" class="form-control" id="inputAddress" name="contact">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Query or Suggestion</label>
                <input type="text" class="form-control" id="inputAddress" name="query">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>