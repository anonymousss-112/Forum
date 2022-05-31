<?php
include 'connect.php';
session_start();
echo '<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">FooDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link " href="contact.php">Contact Us</a>
        </li>

        <li class="nav-item">
          <a class="nav-link " href="recipies.php">Browse recipies</a>
        </li>

      
       <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         Categories
       </a>
       <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

       if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])==true){
        echo '<li><a class="dropdown-item" href="addCat.php"><b>Add category</b></a></li><hr>';}
        
      $sql = "SELECT * FROM `categories` LIMIT 7";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($result)){
        $cat = $row['category_name'];
        $catid = $row['sno'];
        echo '
        
          <li><a class="dropdown-item" href="threadlist.php?catid=' .$catid.'">'.$cat.'</a></li>
        
      ';
      }
      echo '</ul> </li> </ul>';
      // <li class="nav-item">
      //     <a class="nav-link" href="about.php">About Us</a>
      //   </li>

      if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])==true){
          echo '<form class="d-flex" action="search.php" method="get">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success mx-2" type="submit">Search</button>
          <p class="text-light my-2">Welcome </p>
          <a href="logout.php" class="btn btn-success mx-2">Logout</a>
          </form>';
      }
      else{
      echo '<form class="d-flex"  action="search.php" method="get">
        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success mx-2" type="submit">Search</button>
        <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
      </form>';
      }
    echo '</div>
  </div>
</nav>';
include 'loginModal.php';
include 'signupModal.php';


if(isset($_GET['signupsuccess'])){
  $showError = $_GET['error'];
  if($showError=="No error"){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
             <strong>You have signed up now you can login!</strong> 
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
  }
  else{
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>'. $showError .'</strong> 
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
  }
}
?>
