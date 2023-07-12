<?php 
session_start();
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">TechyForum</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="http://localhost/forum/threadlist.php?catid=1">Python</a>
          <a class="dropdown-item" href="http://localhost/forum/threadlist.php?catid=2">JavaScript</a>
          <a class="dropdown-item" href="http://localhost/forum/threadlist.php?catid=4">PHP</a>
          <a class="dropdown-item" href="http://localhost/forum/threadlist.php?catid=3">Laravel</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact Us <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About Us <span class="sr-only"></span></a>
      </li>
    </ul>';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="get">
      <p class="text-light my-0">Welcome ' . $_SESSION['username'].'
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    </form>
      <a href="partials/_logout.php" class="btn btn-outline-success ml-2">Log Out</a>';
    }
    else {echo '
    <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    </form>
      <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModalCenter">Log In</button>
      <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#signupModalCenter">Sign Up</button>';
    }
    echo '
  </div>
</nav>';
    
if (isset($_GET['loginfailed']) && ($_GET['loginfailed']==true) ){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Login Failed!</strong> Wrong Cridentials.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
// else 
// if (!isset($_GET['loginsuccess']) && ($_GET['error'] == "WrongPassword")){
//   echo
//   '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
//   <strong>Login Failed!</strong> Wrong Password.
//   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//     <span aria-hidden="true">&times;</span>
//   </button>
// </div>';
// }
// else if (isset($_GET['loginsuccess']) && ($_GET['loginsuccess']==true)){
//   echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
//   <strong>Success!</strong> You are now logged in.
//   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//     <span aria-hidden="true">&times;</span>
//   </button>
// </div>';
// }



if (isset($_GET['signupsuccess']) && ($_GET['signupsuccess'] == "true")){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You can now login.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
else
if (isset($_GET['signupsuccess']) && ($_GET['error'] == "Email or Username already in use")){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Failure!</strong> Email or username already in use.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
else
if (isset($_GET['signupsuccess']) && ($_GET['error'] == "Passwords do not match")){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Failure!</strong> Passwords do not match.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}




include 'partials/_login.php';
include 'partials/_signup.php';
?>